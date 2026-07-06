<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Motorcycle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'brand',
        'card_image',
        'original_price',
        'sale_price',
        'offer_label',
        'offer_note',
        'specs',
        'hero_background',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'original_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'specs' => 'array',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Motorcycle $motorcycle) {
            if (empty($motorcycle->slug) && filled($motorcycle->name)) {
                $motorcycle->slug = Str::slug($motorcycle->name);
            }

            $motorcycle->specs = self::normalizeSpecs($motorcycle->specs);
        });
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
            ],
            $items
        );
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
            ],
            $specs
        );

        return array_chunk($specs, 8);
    }

    public function offerColorLabels(): string
    {
        $labels = $this->colorVariants->pluck('label')->filter()->all();

        return $labels ? implode(', ', $labels) : 'selected colors';
    }

    public function engineCapacity(): ?string
    {
        foreach (self::normalizeSpecs($this->specs) as $spec) {
            if (($spec['label'] ?? '') === 'Engine Capacity' && filled($spec['value'] ?? null)) {
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
            return asset('storage/' . $normalized);
        }

        if (file_exists(public_path($normalized))) {
            return asset($normalized);
        }

        return asset($normalized);
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
