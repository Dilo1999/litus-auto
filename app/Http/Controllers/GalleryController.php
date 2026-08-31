<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use App\Models\GalleryImage;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use AppliesPageSeo;

    public function index(): View
    {
        $this->applySeo('gallery');

        $showCustomerMoments = (bool) config('gallery.customer_moments_visible', false);

        $images = GalleryImage::query()
            ->published()
            ->whereIn('category', array_values(array_filter([
                GalleryImage::CATEGORY_MOTORCYCLES,
                $showCustomerMoments ? GalleryImage::CATEGORY_CUSTOMER_MOMENTS : null,
            ])))
            ->ordered()
            ->get();

        $allImages = $images
            ->map(fn (GalleryImage $image) => $image->toFrontendArray())
            ->values()
            ->all();

        $featuredPool = $images->where('is_featured', true)->values();

        // Prefer a balanced mix across categories, then shuffle and keep 5.
        $featuredCategories = array_values(array_filter([
            GalleryImage::CATEGORY_MOTORCYCLES,
            $showCustomerMoments ? GalleryImage::CATEGORY_CUSTOMER_MOMENTS : null,
        ]));

        $featuredMoments = collect($featuredCategories)
            ->flatMap(function (string $category) use ($featuredPool) {
                return $featuredPool->where('category', $category)->shuffle()->take(3);
            })
            ->unique('id')
            ->shuffle()
            ->take(5)
            ->values()
            ->map(fn (GalleryImage $image) => $image->toFeaturedArray())
            ->all();

        // If fewer than 5 after balancing, fill from remaining featured images.
        if (count($featuredMoments) < 5) {
            $selectedIds = collect($featuredMoments)->pluck('id')->all();
            $extra = $featuredPool
                ->reject(fn (GalleryImage $image) => in_array($image->id, $selectedIds, true))
                ->shuffle()
                ->take(5 - count($featuredMoments))
                ->map(fn (GalleryImage $image) => $image->toFeaturedArray())
                ->all();

            $featuredMoments = array_values(array_merge($featuredMoments, $extra));
            shuffle($featuredMoments);
        }

        $customerMoments = $images
            ->where('category', GalleryImage::CATEGORY_CUSTOMER_MOMENTS)
            ->values()
            ->map(fn (GalleryImage $image) => $image->toFrontendArray())
            ->all();

        $catColors = array_filter([
            'Motorcycles' => '#E31E25',
            'Customer Moments' => $showCustomerMoments ? '#16A34A' : null,
        ], fn ($color) => $color !== null);

        $momentCategories = array_values(array_filter([
            'All',
            'Motorcycles',
            $showCustomerMoments ? 'Customer Moments' : null,
            'Videos',
        ]));

        $heroFeatures = array_values(array_filter([
            ['icon' => 'bike', 'title' => 'Motorcycles', 'desc' => 'Adventure & street ride moments'],
            $showCustomerMoments
                ? ['icon' => 'users', 'title' => 'Customer Moments', 'desc' => 'Real experiences from our riders']
                : null,
            ['icon' => 'images', 'title' => 'Full Gallery', 'desc' => 'Browse every published moment'],
        ]));

        $galleryVideos = array_map(
            fn (string $url) => $this->resolveTikTokVideo($url),
            [
                'https://www.tiktok.com/@litus.automobiles/video/7496836349077523719',
                'https://www.tiktok.com/@litus.automobiles/video/7660491762992942344',
                'https://www.tiktok.com/@litus.automobiles/video/7660407464843545863',
                'https://www.tiktok.com/@litus.automobiles/video/7653814327799008520',
                'https://www.tiktok.com/@litus.automobiles/video/7647059001359846674',
            ]
        );

        return view('gallery', compact(
            'allImages',
            'featuredMoments',
            'customerMoments',
            'catColors',
            'momentCategories',
            'heroFeatures',
            'galleryVideos',
            'showCustomerMoments',
        ));
    }

    private function resolveTikTokVideo(string $url): array
    {
        preg_match('/video\/(\d+)/', $url, $matches);
        $videoId = $matches[1] ?? null;

        if (! $videoId) {
            throw new \InvalidArgumentException('Invalid TikTok video URL.');
        }

        $localThumb = $this->localTikTokThumbUrl($videoId);
        $meta = Cache::get("gallery.tiktok.{$videoId}");

        if (! is_array($meta)) {
            $meta = $this->fetchTikTokOembed($url);

            if (is_array($meta)) {
                Cache::put("gallery.tiktok.{$videoId}", $meta, now()->addHours(12));
            }
        }

        if ($localThumb === null && is_array($meta) && filled($meta['thumbnail_url'] ?? null)) {
            $localThumb = $this->storeTikTokThumb($videoId, $meta['thumbnail_url']);
        }

        $fallbackThumb = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

        return [
            'id' => $videoId,
            'embed_url' => 'https://www.tiktok.com/player/v1/' . $videoId . '?autoplay=1',
            'thumb' => $localThumb ?? (is_array($meta) ? ($meta['thumbnail_url'] ?? $fallbackThumb) : $fallbackThumb),
            'title' => is_array($meta) && filled($meta['title'] ?? null)
                ? Str::limit($meta['title'], 90)
                : 'LITUS Automobiles',
        ];
    }

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

    private function localTikTokThumbPath(string $videoId): string
    {
        return public_path('images/gallery/tiktok/' . $videoId . '.jpg');
    }

    private function localTikTokThumbUrl(string $videoId): ?string
    {
        if (! is_file($this->localTikTokThumbPath($videoId))) {
            return null;
        }

        return asset('images/gallery/tiktok/' . $videoId . '.jpg');
    }

    private function storeTikTokThumb(string $videoId, string $remoteUrl): ?string
    {
        try {
            $response = $this->tikTokHttpClient()->get($remoteUrl);

            if (! $response->successful()) {
                return null;
            }

            $directory = public_path('images/gallery/tiktok');
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            file_put_contents($this->localTikTokThumbPath($videoId), $response->body());

            return $this->localTikTokThumbUrl($videoId);
        } catch (\Throwable) {
            return null;
        }
    }
}
