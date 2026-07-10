<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryImage extends Model
{
    public const CATEGORY_MOTORCYCLES = 'motorcycles';

    public const CATEGORY_SHOWROOMS = 'showrooms';

    public const CATEGORY_CUSTOMER_MOMENTS = 'customer_moments';

    protected $fillable = [
        'category',
        'title',
        'image',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (GalleryImage $image) {
            if (! filled($image->sort_order) || (int) $image->sort_order === 0) {
                $image->sort_order = self::nextSortOrderForCategory($image->category);
            }
        });
    }

    public static function nextSortOrderForCategory(?string $category): int
    {
        if (! $category) {
            return 1;
        }

        $max = static::query()
            ->where('category', $category)
            ->max('sort_order');

        return ((int) $max) + 1;
    }

    public static function categoryOptions(): array
    {
        return [
            self::CATEGORY_MOTORCYCLES => 'Motorcycles',
            self::CATEGORY_SHOWROOMS => 'Showrooms',
            self::CATEGORY_CUSTOMER_MOMENTS => 'Customer Moments',
        ];
    }

    public function categoryLabel(): string
    {
        return self::categoryOptions()[$this->category] ?? ucfirst(str_replace('_', ' ', $this->category));
    }

    /**
     * Frontend filter / badge category keys used by gallery.js
     */
    public function frontendCategory(): string
    {
        return match ($this->category) {
            self::CATEGORY_SHOWROOMS => 'Showroom',
            self::CATEGORY_CUSTOMER_MOMENTS => 'Customer Moments',
            default => 'Motorcycles',
        };
    }

    public function badgeLabel(): string
    {
        return match ($this->category) {
            self::CATEGORY_SHOWROOMS => 'Showroom',
            self::CATEGORY_CUSTOMER_MOMENTS => 'Customer Moment',
            default => 'Motorcycle',
        };
    }

    public function imageUrl(): string
    {
        if (! $this->image) {
            return '';
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $normalized = ltrim($this->image, '/');

        if (Storage::disk('public')->exists($normalized)) {
            return asset('storage/'.$this->encodePath($normalized));
        }

        return asset($this->encodePath($normalized));
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOfCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function toFrontendArray(): array
    {
        return [
            'id' => $this->id,
            'cat' => $this->frontendCategory(),
            'label' => $this->title ?: '',
            'img' => $this->imageUrl(),
        ];
    }

    public function toFeaturedArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->title ?: '',
            'cat' => $this->frontendCategory(),
            'badge' => $this->badgeLabel(),
            'badgeRed' => $this->category === self::CATEGORY_CUSTOMER_MOMENTS,
            'img' => $this->imageUrl(),
            'large' => $this->category === self::CATEGORY_MOTORCYCLES,
        ];
    }

    private function encodePath(string $path): string
    {
        return collect(explode('/', ltrim($path, '/')))
            ->map(fn (string $segment) => rawurlencode($segment))
            ->implode('/');
    }
}
