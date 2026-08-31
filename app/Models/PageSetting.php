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
            ->reject(fn (array $definition, string $routeName) => $routeName === 'motorcycle.show')
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
                'desktop' => 'images/ownership_plans/ChatGPT Image Jul 4, 2026, 02_28_02 PM.png',
                'mobile' => 'images/ownership_plans/ChatGPT Image Jul 4, 2026, 02_28_02 PM.png',
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
