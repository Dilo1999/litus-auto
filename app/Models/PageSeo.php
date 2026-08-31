<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageSeo extends Model
{
    protected $table = 'page_seo';

    protected $fillable = [
        'route_name',
        'page_label',
        'meta_title',
        'meta_description',
        'og_image',
        'robots',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public const ROBOTS_INDEX = 'index,follow';

    public const ROBOTS_NOINDEX = 'noindex,nofollow';

    /**
     * @return array<string, array{label: string, sort: int, defaults: array<string, string|null>}>
     */
    public static function pageDefinitions(): array
    {
        return [
            'home' => [
                'label' => 'Home',
                'sort' => 1,
                'defaults' => [
                    'meta_title' => 'LITUS Automobiles - Motorcycles, Scooters & Ijara Ownership Plans in the Maldives',
                    'meta_description' => 'Honda and Yamaha scooters, genuine parts and expert service across five showrooms in the Maldives. Own from MVR 1,340 a month on a Shariah-compliant Ijara plan.',
                ],
            ],
            'about' => [
                'label' => 'About Us',
                'sort' => 2,
                'defaults' => [
                    'meta_title' => 'About Us - LITUS Automobiles',
                    'meta_description' => 'Learn about LITUS Automobiles, our team, showrooms and commitment to riders across the Maldives.',
                ],
            ],
            'motorcycles' => [
                'label' => 'Motorcycles Listing',
                'sort' => 3,
                'defaults' => [
                    'meta_title' => 'Motorcycles - LITUS Automobiles',
                    'meta_description' => 'Browse Honda and Yamaha motorcycles and scooters available at LITUS Automobiles in the Maldives.',
                ],
            ],
            'motorcycle.show' => [
                'label' => 'Motorcycle Detail (template)',
                'sort' => 4,
                'defaults' => [
                    'meta_title' => '{name} - LITUS Automobiles',
                    'meta_description' => 'View specs, pricing and Ijara plans for the {name}. Available at LITUS Automobiles in the Maldives.',
                ],
            ],
            'promotions' => [
                'label' => 'Promotions',
                'sort' => 5,
                'defaults' => [
                    'meta_title' => 'Promotions - LITUS Automobiles',
                    'meta_description' => 'See current motorcycle promotions, limited-time offers and savings at LITUS Automobiles.',
                ],
            ],
            'ownership-plans' => [
                'label' => 'Ijara Ownership Plans',
                'sort' => 6,
                'defaults' => [
                    'meta_title' => 'Ijara Plans - LITUS Automobiles',
                    'meta_description' => 'Shariah-compliant Ijara ownership plans for motorcycles and scooters in the Maldives.',
                ],
            ],
            'parts' => [
                'label' => 'Genuine Parts',
                'sort' => 7,
                'defaults' => [
                    'meta_title' => 'Genuine Parts - LITUS Automobiles',
                    'meta_description' => 'Order genuine Honda and Yamaha parts with expert support from LITUS Automobiles.',
                ],
            ],
            'service-center' => [
                'label' => 'Service Centre',
                'sort' => 8,
                'defaults' => [
                    'meta_title' => 'Service Centre - LITUS Automobiles',
                    'meta_description' => 'Book service and maintenance for your motorcycle at LITUS service centres across the Maldives.',
                ],
            ],
            'contact' => [
                'label' => 'Contact Us',
                'sort' => 9,
                'defaults' => [
                    'meta_title' => 'Contact Us - LITUS Automobiles',
                    'meta_description' => 'Contact LITUS Automobiles showrooms and service centres in the Maldives.',
                ],
            ],
            'gallery' => [
                'label' => 'Gallery',
                'sort' => 10,
                'defaults' => [
                    'meta_title' => 'Gallery - LITUS Automobiles',
                    'meta_description' => 'Explore ride moments, customer stories and LITUS motorcycles across the Maldives.',
                ],
            ],
        ];
    }

    public static function forRoute(string $routeName): ?self
    {
        if (! static::tableExists()) {
            return null;
        }

        return Cache::rememberForever("page_seo.{$routeName}", function () use ($routeName) {
            return static::query()->where('route_name', $routeName)->first();
        });
    }

    public static function tableExists(): bool
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasTable('page_seo');
        } catch (\Throwable) {
            return false;
        }
    }

    public static function clearCache(?string $routeName = null): void
    {
        if ($routeName) {
            Cache::forget("page_seo.{$routeName}");

            return;
        }

        foreach (array_keys(static::pageDefinitions()) as $name) {
            Cache::forget("page_seo.{$name}");
        }
    }

    protected static function booted(): void
    {
        static::saved(fn (self $pageSeo) => static::clearCache($pageSeo->route_name));
        static::deleted(fn (self $pageSeo) => static::clearCache($pageSeo->route_name));
    }

    public function getOgImageUrlAttribute(): ?string
    {
        return static::resolveImageUrl($this->og_image);
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

    public function applyPlaceholders(array $replacements): array
    {
        return [
            'meta_title' => static::replacePlaceholders($this->meta_title, $replacements),
            'meta_description' => static::replacePlaceholders($this->meta_description, $replacements),
        ];
    }

    public static function replacePlaceholders(?string $value, array $replacements): ?string
    {
        if ($value === null) {
            return null;
        }

        $result = $value;

        foreach ($replacements as $key => $replacement) {
            $result = str_replace('{'.$key.'}', (string) $replacement, $result);
        }

        return $result;
    }
}
