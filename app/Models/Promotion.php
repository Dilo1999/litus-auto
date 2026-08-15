<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'offer_note',
        'starts_at',
        'ends_at',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Promotion $promotion) {
            if (! filled($promotion->sort_order) || (int) $promotion->sort_order === 0) {
                $promotion->sort_order = ((int) static::query()->max('sort_order')) + 1;
            }

            $promotion->starts_at = now();
        });
    }

    public function motorcycles(): BelongsToMany
    {
        return $this->belongsToMany(Motorcycle::class, 'promotion_motorcycle')
            ->withPivot(['sale_price'])
            ->withTimestamps();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeCurrentlyActive(Builder $query): Builder
    {
        $now = now();

        return $query
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('id');
    }

    public function isCurrentlyActive(): bool
    {
        if (! $this->is_published) {
            return false;
        }

        if ($this->starts_at && $this->starts_at->isFuture()) {
            return false;
        }

        if ($this->ends_at && $this->ends_at->isPast()) {
            return false;
        }

        return true;
    }

    public function maxDiscountAmount(): float
    {
        return (float) $this->motorcycles
            ->map(fn (Motorcycle $motorcycle) => max(
                0,
                (float) $motorcycle->original_price - (float) $motorcycle->pivot->sale_price
            ))
            ->max();
    }

    public function minSalePrice(): float
    {
        $prices = $this->motorcycles
            ->map(fn (Motorcycle $motorcycle) => (float) $motorcycle->pivot->sale_price)
            ->filter(fn ($price) => $price > 0);

        return (float) ($prices->min() ?: 0);
    }

    public function formattedMaxDiscount(): string
    {
        return 'MVR '.number_format($this->maxDiscountAmount(), 0);
    }

    public function formattedMinSalePrice(): string
    {
        return 'MVR '.number_format($this->minSalePrice(), 0);
    }
}
