<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Motorcycle extends Model
{
    public const OFFER_LABEL = 'Limited Offer';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'brand',
        'card_image',
        'original_price',
        'has_promotion',
        'sale_price',
        'offer_note',
        'specs',
        'hero_background',
        'is_published',
        'is_top_selling',
        'sort_order',
    ];

    protected $casts = [
        'original_price' => 'decimal:2',
        'has_promotion' => 'boolean',
        'sale_price' => 'decimal:2',
        'specs' => 'array',
        'is_published' => 'boolean',
        'is_top_selling' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Motorcycle $motorcycle) {
            if (empty($motorcycle->slug) && filled($motorcycle->name)) {
                $motorcycle->slug = Str::slug($motorcycle->name);
            }

            $motorcycle->specs = self::normalizeSpecs($motorcycle->specs);

            if (! $motorcycle->has_promotion) {
                $motorcycle->sale_price = $motorcycle->original_price;
                $motorcycle->offer_label = null;
                $motorcycle->offer_note = null;
            } else {
                $motorcycle->offer_label = self::OFFER_LABEL;
            }
        });
    }

    public function hasPromotion(): bool
    {
        return (bool) $this->has_promotion;
    }

    public function offerLabel(): string
    {
        return self::OFFER_LABEL;
    }

    public static function defaultSpecLabels(): array
    {
        return [
            'Engine Capacity',
            'Fuel Type',
            'Carburation',
            'Brakes Front',
            'Brakes Rear',
            'Suspension Front',
            'Wheels Front',
            'Wheels Rear',
            'Fuel Tank Capacity',
            'Ground Clearance',
            'Frame Type',
            'Net Weight',
            'Seat Height',
            'Clutch',
            'Final Drive',
            'Transmission Type',
        ];
    }

    public static function defaultSpecsTemplate(): array
    {
        return array_map(
            fn (string $label) => ['label' => $label, 'value' => ''],
            self::defaultSpecLabels()
        );
    }

    public static function normalizeSpecs(?array $saved): array
    {
        $savedByLabel = collect($saved ?? [])->keyBy('label');

        return array_map(
            fn (string $label) => [
                'label' => $label,
                'value' => (string) ($savedByLabel->get($label)['value'] ?? ''),
            ],
            self::defaultSpecLabels()
        );
    }

    public function colorVariants(): HasMany
    {
        return $this->hasMany(MotorcycleColorVariant::class)->orderBy('sort_order');
    }

    public function defaultColorVariant(): ?MotorcycleColorVariant
    {
        return $this->colorVariants->firstWhere('is_default', true)
            ?? $this->colorVariants->first();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function formattedOriginalPrice(): string
    {
        return 'MVR ' . number_format((float) $this->original_price, 2);
    }

    public function formattedSalePrice(): string
    {
        return 'MVR ' . number_format((float) $this->sale_price, 2);
    }

    public function discountAmount(): float
    {
        if (! $this->hasPromotion()) {
            return 0;
        }

        return max(0, (float) $this->original_price - (float) $this->sale_price);
    }

    public function formattedDiscount(): string
    {
        return 'MVR ' . number_format($this->discountAmount(), 0);
    }

    public function heroBackgroundUrl(): string
    {
        return self::resolveImageUrl($this->hero_background)
            ?? asset('images/motorcycles/details/' . rawurlencode('ChatGPT Image Jul 4, 2026, 12_38_11 PM.png'));
    }

    public function highlights(): array
    {
        $items = array_values(array_filter(
            array_slice(self::normalizeSpecs($this->specs), 0, 4),
            fn (array $spec) => filled($spec['value'] ?? null)
        ));

        return array_map(
            fn (array $spec) => [
                ...$spec,
                'icon' => self::iconForSpecLabel($spec['label'] ?? ''),
                'icon_url' => self::specIconUrlForLabel($spec['label'] ?? ''),
            ],
            $items
        );
    }

    public static function specIconUrlForLabel(string $label): ?string
    {
        return match ($label) {
            'Engine Capacity' => self::detailsPageIcon('icons8-engine-50 (2).png'),
            'Fuel Type' => self::detailsPageIcon('gasoline.png'),
            'Carburation' => self::detailsPageIcon('carburettor.png'),
            'Brakes Front', 'Brakes Rear' => self::detailsPageIcon('brakes.png'),
            'Suspension Front' => self::detailsPageIcon('suspension.png'),
            'Wheels Front', 'Wheels Rear' => self::detailsPageIcon('tyre.png'),
            'Fuel Tank Capacity' => self::detailsPageIcon('fuel-gas.png'),
            'Ground Clearance' => self::detailsPageIcon('ground.png'),
            'Frame Type' => self::detailsPageIcon('frame.png'),
            'Net Weight' => self::detailsPageIcon('weight.png'),
            default => null,
        };
    }

    private static function detailsPageIcon(string $filename): string
    {
        return asset('images/details_page/' . rawurlencode($filename));
    }

    public static function iconForSpecLabel(string $label): string
    {
        return match ($label) {
            'Engine Capacity' => 'gauge',
            'Fuel Type' => 'zap',
            'Carburation' => 'cpu',
            'Brakes Front', 'Brakes Rear' => 'disc',
            'Suspension Front', 'Ground Clearance', 'Seat Height' => 'arrow-up-down',
            'Wheels Front', 'Wheels Rear' => 'circle',
            'Fuel Tank Capacity' => 'fuel',
            'Frame Type' => 'shield',
            'Net Weight' => 'weight',
            'Clutch', 'Final Drive', 'Transmission Type' => 'settings',
            default => 'gauge',
        };
    }

    public function specColumns(): array
    {
        $specs = array_values(array_filter(
            self::normalizeSpecs($this->specs),
            fn (array $spec) => filled($spec['value'] ?? null)
        ));

        $specs = array_map(
            fn (array $spec) => [
                ...$spec,
                'icon' => self::iconForSpecLabel($spec['label'] ?? ''),
                'icon_url' => self::specIconUrlForLabel($spec['label'] ?? ''),
            ],
            $specs
        );

        return array_chunk($specs, 8);
    }

    public function specGroups(): array
    {
        $specs = array_values(array_filter(
            self::normalizeSpecs($this->specs),
            fn (array $spec) => filled($spec['value'] ?? null)
        ));

        $specsByLabel = [];
        foreach ($specs as $spec) {
            $label = $spec['label'] ?? '';
            if ($label === '') {
                continue;
            }

            $specsByLabel[$label] = [
                ...$spec,
                'icon' => self::iconForSpecLabel($label),
                'icon_url' => self::specIconUrlForLabel($label),
            ];
        }

        $groups = [
            [
                'title' => 'Performance',
                'icon' => 'gauge',
                'labels' => ['Engine Capacity', 'Fuel Type', 'Carburation', 'Transmission Type', 'Fuel Tank Capacity'],
            ],
            [
                'title' => 'Safety & Braking',
                'icon' => 'shield',
                'labels' => ['Brakes Front', 'Brakes Rear'],
            ],
            [
                'title' => 'Ride & Comfort',
                'icon' => 'arrow-up-down',
                'labels' => ['Suspension Front', 'Seat Height', 'Ground Clearance', 'Net Weight'],
            ],
            [
                'title' => 'Build & Drivetrain',
                'icon' => 'settings',
                'labels' => ['Frame Type', 'Clutch', 'Final Drive', 'Wheels Front', 'Wheels Rear'],
            ],
        ];

        $result = [];

        foreach ($groups as $group) {
            $items = [];

            foreach ($group['labels'] as $label) {
                if (isset($specsByLabel[$label])) {
                    $items[] = $specsByLabel[$label];
                }
            }

            if ($items !== []) {
                $result[] = [
                    'title' => $group['title'],
                    'icon' => $group['icon'],
                    'specs' => $items,
                ];
            }
        }

        $groupedLabels = array_merge(...array_column($groups, 'labels'));
        $ungrouped = array_values(array_filter(
            $specsByLabel,
            fn (array $spec, string $label) => ! in_array($label, $groupedLabels, true),
            ARRAY_FILTER_USE_BOTH
        ));

        if ($ungrouped !== []) {
            $result[] = [
                'title' => 'Additional Details',
                'icon' => 'clipboard-list',
                'specs' => $ungrouped,
            ];
        }

        return $result;
    }

    public function offerColorLabels(): string
    {
        $labels = $this->colorVariants->pluck('label')->filter()->all();

        return $labels ? implode(', ', $labels) : 'selected colors';
    }

    public function engineCapacity(): ?string
    {
        return $this->specValue('Engine Capacity');
    }

    public function fuelTankCapacity(): ?string
    {
        return $this->specValue('Fuel Tank Capacity');
    }

    public function specValue(string $label): ?string
    {
        foreach (self::normalizeSpecs($this->specs) as $spec) {
            if (($spec['label'] ?? '') === $label && filled($spec['value'] ?? null)) {
                return $spec['value'];
            }
        }

        return null;
    }

    public function listImageUrl(): string
    {
        if ($url = self::resolveImageUrl($this->card_image)) {
            return $url;
        }

        $variant = $this->relationLoaded('colorVariants')
            ? $this->defaultColorVariant()
            : $this->colorVariants()->orderBy('sort_order')->first();

        $gallery = $variant?->galleryImageUrls() ?? [];
        $spin = $variant?->spinFrameUrls() ?? [];

        return $gallery[0] ?? $spin[0] ?? asset('images/product/' . rawurlencode('premium 125 blue.png'));
    }

    public static function resolveImageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $normalized = ltrim($path, '/');

        if (Storage::disk('public')->exists($normalized)) {
            return self::storageAssetUrl($normalized);
        }

        if (file_exists(public_path($normalized))) {
            return self::publicAssetUrl($normalized);
        }

        return self::publicAssetUrl($normalized);
    }

    private static function storageAssetUrl(string $path): string
    {
        return asset('storage/'.self::encodeAssetPath($path));
    }

    private static function publicAssetUrl(string $path): string
    {
        return asset(self::encodeAssetPath($path));
    }

    private static function encodeAssetPath(string $path): string
    {
        return collect(explode('/', ltrim($path, '/')))
            ->map(fn (string $segment) => rawurlencode($segment))
            ->implode('/');
    }

    public function spinFramesByColor(): array
    {
        $map = [];

        foreach ($this->colorVariants as $variant) {
            $map[$variant->label] = $variant->spinFrameUrls();
        }

        return $map;
    }

    public function galleryByColor(): array
    {
        $map = [];

        foreach ($this->colorVariants as $variant) {
            $map[$variant->label] = $variant->galleryImageUrls();
        }

        return $map;
    }
}
