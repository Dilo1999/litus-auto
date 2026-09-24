<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class IjaraPlan extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'tag',
        'color',
        'bg',
        'description',
        'points',
        'best_for',
        'drawer_subtitle',
        'full_description',
        'benefits',
        'eligibility',
        'documents',
        'who_for',
        'important_note',
        'terms',
        'show_in_calculator',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'points' => 'array',
        'benefits' => 'array',
        'documents' => 'array',
        'terms' => 'array',
        'show_in_calculator' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function tableExists(): bool
    {
        try {
            return Schema::hasTable('ijara_plans');
        } catch (\Throwable) {
            return false;
        }
    }

    /** @return Collection<int, self> */
    public static function published(): Collection
    {
        return Cache::rememberForever('ijara_plans.published', fn () => static::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get());
    }

    protected static function booted(): void
    {
        // New plans go to the end of the list.
        static::creating(function (self $plan) {
            if (! $plan->sort_order) {
                $plan->sort_order = (int) static::max('sort_order') + 1;
            }
        });

        static::saved(fn () => Cache::forget('ijara_plans.published'));
        static::deleted(fn () => Cache::forget('ijara_plans.published'));
    }

    /** Repeater rows ([['value' => '…']]) or plain strings → clean list of strings. */
    public static function flattenList(?array $items): array
    {
        return collect($items)
            ->map(fn ($item) => is_array($item) ? ($item['value'] ?? '') : $item)
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }

    /** Shape used by the public Ijara Plans page and its details modal. */
    public function toPageArray(): array
    {
        $terms = collect($this->terms)->map(fn ($t) => (int) $t)->unique()->sort()->values()->all();

        return [
            'id' => $this->slug,
            'name' => $this->name,
            'tag' => (string) $this->tag,
            'color' => $this->color,
            'bg' => $this->bg,
            'accent' => $this->color,
            'accentLight' => $this->bg,
            'icon' => 'star',
            'desc' => (string) $this->description,
            'pts' => static::flattenList($this->points),
            'best' => (string) $this->best_for,
            'terms' => $terms,
            'calculator' => (bool) $this->show_in_calculator,
            'drawer' => array_filter([
                'subtitle' => (string) $this->drawer_subtitle,
                'fullDesc' => (string) $this->full_description,
                'benefits' => static::flattenList($this->benefits),
                'eligibility' => (string) $this->eligibility,
                'docs' => static::flattenList($this->documents),
                'whoFor' => (string) $this->who_for,
                'important' => filled($this->important_note) ? $this->important_note : null,
            ], fn ($v) => $v !== null),
        ];
    }
}
