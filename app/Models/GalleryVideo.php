<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryVideo extends Model
{
    protected $fillable = [
        'title',
        'video_url',
        'thumbnail',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (GalleryVideo $video) {
            if (! filled($video->sort_order) || (int) $video->sort_order === 0) {
                $video->sort_order = ((int) static::query()->max('sort_order')) + 1;
            }
        });
    }

    public static function extractTikTokVideoId(string $url): ?string
    {
        if (preg_match('/video\/(\d+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function tiktokVideoId(): ?string
    {
        return self::extractTikTokVideoId($this->video_url);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function embedUrl(): string
    {
        $videoId = $this->tiktokVideoId();

        return $videoId
            ? 'https://www.tiktok.com/player/v1/'.$videoId.'?autoplay=1'
            : '';
    }

    public function thumbnailUrl(): string
    {
        if (filled($this->thumbnail)) {
            return $this->resolveStorageUrl($this->thumbnail);
        }

        $videoId = $this->tiktokVideoId();

        if ($videoId) {
            $legacyThumb = public_path('images/gallery/tiktok/'.$videoId.'.jpg');

            if (is_file($legacyThumb)) {
                return asset('images/gallery/tiktok/'.$videoId.'.jpg');
            }
        }

        $meta = $this->tikTokOembedMeta();

        if (filled($meta['thumbnail_url'] ?? null)) {
            return $meta['thumbnail_url'];
        }

        return asset('images/motorcycles/'.rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));
    }

    public function displayTitle(): string
    {
        if (filled($this->title)) {
            return $this->title;
        }

        $meta = $this->tikTokOembedMeta();
        $oembedTitle = $meta['title'] ?? null;

        if (filled($oembedTitle)) {
            return Str::limit($oembedTitle, 90);
        }

        return 'LITUS Automobiles';
    }

    /**
     * @return array{id: string|null, embed_url: string, thumb: string, title: string}
     */
    public function toFrontendArray(): array
    {
        return [
            'id' => $this->tiktokVideoId(),
            'embed_url' => $this->embedUrl(),
            'thumb' => $this->thumbnailUrl(),
            'title' => $this->displayTitle(),
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    private function tikTokOembedMeta(): ?array
    {
        $videoId = $this->tiktokVideoId();

        if (! $videoId) {
            return null;
        }

        $cacheKey = "gallery.tiktok.{$videoId}";
        $meta = Cache::get($cacheKey);

        if (is_array($meta)) {
            return $meta;
        }

        $meta = $this->fetchTikTokOembed($this->video_url);

        if (is_array($meta)) {
            Cache::put($cacheKey, $meta, now()->addHours(12));
        }

        return $meta;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function fetchTikTokOembed(string $url): ?array
    {
        try {
            $response = $this->tikTokHttpClient()->get('https://www.tiktok.com/oembed', [
                'url' => $url,
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Throwable) {
        }

        return null;
    }

    private function tikTokHttpClient(): PendingRequest
    {
        $client = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'Accept' => 'application/json',
        ])->timeout(15);

        if (app()->environment('local')) {
            $client = $client->withoutVerifying();
        }

        return $client;
    }

    private function resolveStorageUrl(string $path): string
    {
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $normalized = ltrim($path, '/');

        if (Storage::disk('public')->exists($normalized)) {
            return asset('storage/'.$this->encodePath($normalized));
        }

        return asset($this->encodePath($normalized));
    }

    private function encodePath(string $path): string
    {
        return collect(explode('/', ltrim($path, '/')))
            ->map(fn (string $segment) => rawurlencode($segment))
            ->implode('/');
    }
}
