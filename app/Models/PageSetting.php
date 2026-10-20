<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class PageSetting extends Model
{
    protected $fillable = [
        'route_name',
        'page_label',
        'hero_image_desktop',
        'hero_image_mobile',
        'hero_video_desktop',
        'hero_video_url',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * @return array<string, array{label: string, sort: int}>
     */
    public static function pageDefinitions(): array
    {
        return collect(PageSeo::pageDefinitions())
            ->reject(fn (array $definition, string $routeName) => in_array($routeName, ['motorcycle.show', 'promotions'], true))
            ->map(fn (array $definition, string $routeName) => [
                'label' => $definition['label'],
                'sort' => $definition['sort'],
            ])
            ->all();
    }

    public static function forRoute(string $routeName): ?self
    {
        if (! static::tableExists()) {
            return null;
        }

        return Cache::rememberForever("page_settings.{$routeName}", function () use ($routeName) {
            return static::query()->where('route_name', $routeName)->first();
        });
    }

    public static function tableExists(): bool
    {
        try {
            return Schema::hasTable('page_settings');
        } catch (\Throwable) {
            return false;
        }
    }

    public static function clearCache(?string $routeName = null): void
    {
        if ($routeName) {
            Cache::forget("page_settings.{$routeName}");

            return;
        }

        foreach (array_keys(static::pageDefinitions()) as $name) {
            Cache::forget("page_settings.{$name}");
        }
    }

    protected static function booted(): void
    {
        static::saved(fn (self $pageSetting) => static::clearCache($pageSetting->route_name));
        static::deleted(fn (self $pageSetting) => static::clearCache($pageSetting->route_name));
    }

    public function getHeroImageDesktopUrlAttribute(): ?string
    {
        return static::resolveImageUrl($this->hero_image_desktop);
    }

    public function getHeroImageMobileUrlAttribute(): ?string
    {
        return static::resolveImageUrl($this->hero_image_mobile);
    }

    /**
     * @return array{desktop: string|null, mobile: string|null}
     */
    public static function heroForRoute(string $routeName): array
    {
        $defaults = static::defaultHeroImages()[$routeName] ?? ['desktop' => null, 'mobile' => null];
        $page = static::forRoute($routeName);

        $desktop = filled($page?->hero_image_desktop)
            ? $page->hero_image_desktop_url
            : static::publicAssetUrl($defaults['desktop']);

        $mobile = filled($page?->hero_image_mobile)
            ? $page->hero_image_mobile_url
            : static::publicAssetUrl($defaults['mobile'] ?? $defaults['desktop']);

        if ($mobile === null) {
            $mobile = $desktop;
        }

        return [
            'desktop' => $desktop,
            'mobile' => $mobile,
        ];
    }

    /**
     * Desktop-only hero video. An uploaded file wins over a pasted link; a YouTube or Vimeo
     * link becomes a muted background embed, any other link is played as a direct video file.
     *
     * @return array{type: 'file'|'youtube'|'vimeo', src: string}|null
     */
    public static function heroVideoForRoute(string $routeName): ?array
    {
        $page = static::forRoute($routeName);

        if (filled($page?->hero_video_desktop)) {
            return ['type' => 'file', 'src' => static::resolveImageUrl($page->hero_video_desktop)];
        }

        return static::parseVideoUrl($page?->hero_video_url);
    }

    /**
     * @return array{type: 'file'|'youtube'|'vimeo', src: string}|null
     */
    public static function parseVideoUrl(?string $url): ?array
    {
        $url = trim((string) $url);

        if ($url === '' || ! preg_match('#^https?://#i', $url)) {
            return null;
        }

        if (preg_match('#(?:youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/)|youtu\.be/)([A-Za-z0-9_-]{11})#', $url, $m)) {
            $id = $m[1];

            return [
                'type' => 'youtube',
                // enablejsapi lets the page see when playback really starts, loop it and toggle sound.
                // No loop=1&playlist=… here: that adds prev/next controls, so x-litus-bg-video loops it instead.
                'src' => "https://www.youtube.com/embed/{$id}?autoplay=1&mute=1&controls=0&playsinline=1&rel=0&modestbranding=1&disablekb=1&iv_load_policy=3&fs=0&enablejsapi=1",
            ];
        }

        if (preg_match('#vimeo\.com/(?:video/)?(\d+)#', $url, $m)) {
            return [
                'type' => 'vimeo',
                'src' => "https://player.vimeo.com/video/{$m[1]}?background=1&autoplay=1&loop=1&muted=1",
            ];
        }

        return ['type' => 'file', 'src' => $url];
    }

    /**
     * @return array<string, array{desktop: string|null, mobile: string|null}>
     */
    public static function defaultHeroImages(): array
    {
        return [
            'home' => [
                'desktop' => 'images/homepage/ChatGPT Image Jul 3, 2026, 02_22_48 PM.png',
                'mobile' => 'images/homepage/Website-Banner-mobile-1.webp',
            ],
            'about' => [
                'desktop' => 'images/about_us/img.webp',
                'mobile' => 'images/about_us/img.webp',
            ],
            'motorcycles' => [
                'desktop' => 'images/motorcycles/ChatGPT Image Jul 3, 2026, 02_50_01 PM.png',
                'mobile' => 'images/motorcycles/ChatGPT Image Jul 3, 2026, 02_50_01 PM.png',
            ],
            'ownership-plans' => [
                'desktop' => 'images/ownership_plans/IjiraHero2.webp',
                'mobile' => 'images/ownership_plans/IjiraHero2.webp',
            ],
            'parts' => [
                'desktop' => 'images/parts/ChatGPT Image Jul 3, 2026, 03_07_42 PM.png',
                'mobile' => 'images/parts/ChatGPT Image Jul 3, 2026, 03_07_42 PM.png',
            ],
            'service-center' => [
                'desktop' => 'images/service_center/Image.webp',
                'mobile' => 'images/service_center/Image.webp',
            ],
            'contact' => [
                'desktop' => 'images/contact us/ChatGPT Image Jul 4, 2026, 11_35_33 AM.png',
                'mobile' => 'images/contact us/ChatGPT Image Jul 4, 2026, 11_35_33 AM.png',
            ],
            'gallery' => [
                'desktop' => 'images/motorcycles/ChatGPT Image Jul 3, 2026, 02_50_01 PM.png',
                'mobile' => 'images/motorcycles/ChatGPT Image Jul 3, 2026, 02_50_01 PM.png',
            ],
        ];
    }

    public static function resolveImageUrl(?string $path): ?string
    {
        if (! filled($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public static function publicAssetUrl(?string $path): ?string
    {
        if (! filled($path)) {
            return null;
        }

        $segments = explode('/', $path);

        return asset(implode('/', array_map('rawurlencode', $segments)));
    }
}
