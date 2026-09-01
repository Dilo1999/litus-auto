<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Showroom extends Model
{
    public const SERVICE_OPTIONS = [
        'Sales' => 'Sales',
        'Service Centre' => 'Service Centre',
        'Parts' => 'Parts',
        'Support' => 'Support',
    ];

    protected $fillable = [
        'name',
        'address',
        'phone',
        'services',
        'images',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'services' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Showroom $showroom) {
            if (! filled($showroom->sort_order) || (int) $showroom->sort_order === 0) {
                $showroom->sort_order = ((int) static::query()->max('sort_order')) + 1;
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * @return list<string>
     */
    public function imageUrls(): array
    {
        return collect($this->images ?? [])
            ->filter()
            ->map(fn (string $path) => $this->resolveImageUrl($path))
            ->values()
            ->all();
    }

    public function coverImageUrl(): ?string
    {
        $urls = $this->imageUrls();

        return $urls[0] ?? null;
    }

    /**
     * Shape used by About / Home / Contact blades.
     *
     * @return array{name: string, address: string, phone: string|null, services: array, featured: bool, images: array, img: string|null}
     */
    public function toViewArray(): array
    {
        $images = $this->imageUrls();

        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'services' => array_values($this->services ?? []),
            'featured' => (bool) $this->is_featured,
            'images' => $images,
            'img' => $images[0] ?? null,
        ];
    }

    private function resolveImageUrl(string $path): string
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

    /**
     * Pick & drop zones for the Service Centre page.
     * Contact numbers are resolved from linked showroom records in the database.
     *
     * @return list<array{label: string, phone: string, phone_digits: string}>
     */
    public static function pickDropAreaOptions(): array
    {
        $zones = [
            ['label' => 'Malé', 'showroom' => "Malé Showroom"],
            ['label' => 'Hulhumalé', 'showroom' => 'Hulhumale Showroom'],
            ['label' => 'Villimalé', 'showroom' => "Malé Showroom"],
            ['label' => 'Other nearby areas', 'showroom' => "Malé Showroom"],
        ];

        $showroomNames = collect($zones)->pluck('showroom')->unique()->values()->all();

        $showrooms = static::query()
            ->published()
            ->whereIn('name', $showroomNames)
            ->get()
            ->keyBy('name');

        $fallbackShowroom = static::query()
            ->published()
            ->ordered()
            ->get()
            ->first(fn (self $showroom) => in_array('Service Centre', $showroom->services ?? [], true));

        return collect($zones)
            ->map(function (array $zone) use ($showrooms, $fallbackShowroom) {
                $showroom = $showrooms->get($zone['showroom']) ?? $fallbackShowroom;
                $phone = trim((string) ($showroom?->phone ?? ''));

                if ($phone === '') {
                    return null;
                }

                $digits = preg_replace('/\D+/', '', $phone) ?? '';

                if ($digits === '') {
                    return null;
                }

                return [
                    'label' => $zone['label'],
                    'phone' => $phone,
                    'phone_digits' => $digits,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }
}
