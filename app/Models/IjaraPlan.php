<?php

namespace App\Models;

use App\Support\IjaraPlans;
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
        'term_groups',
        'rate_plan_a',
        'rate_plan_b',
        'show_in_calculator',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'points' => 'array',
        'benefits' => 'array',
        'documents' => 'array',
        'terms' => 'array',
        'term_groups' => 'array',
        'rate_plan_a' => 'float',
        'rate_plan_b' => 'float',
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
        // 'terms' is always the combined list of the months across all options (Plan A, Plan B ...).
        static::saving(function (self $plan) {
            if (is_array($plan->term_groups)) {
                $plan->terms = collect($plan->normalizedGroups())->pluck('months')->flatten()->unique()->sort()->values()->all();
            }
        });

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

    /**
     * The plan's options: always "Plan A" and, optionally, "Plan B", each with its months. An option
     * with no months is left out. Plans saved before options existed are a single Plan A holding all their months.
     *
     * @return list<array{label: string, months: list<int>}>
     */
    public function normalizedGroups(): array
    {
        // Plan A can only hold 6 / 12 / 24 months and Plan B only 36 / 48, so the split follows the month itself.
        $stored = collect($this->term_groups)->pluck('months')->flatten();

        if ($stored->isEmpty()) {
            $stored = collect($this->terms);
        }

        $months = $stored->map(fn ($m) => (int) $m)->unique()->sort()->values();

        return collect(['Plan A' => IjaraPlans::PLAN_A_MONTHS, 'Plan B' => IjaraPlans::PLAN_B_MONTHS])
            ->map(fn (array $allowed, string $label) => [
                'label' => $label,
                'months' => $months->filter(fn ($m) => in_array($m, $allowed, true))->values()->all(),
                // Financial charge rate, % per month (flat), for this option.
                'rate' => (float) ($label === 'Plan A' ? ($this->rate_plan_a ?? 2.5) : ($this->rate_plan_b ?? 2.5)),
            ])
            ->filter(fn ($g) => $g['months'])
            ->values()
            ->all();
    }

    /** Shape used by the public Ijara Plans page and its details modal. */
    public function toPageArray(): array
    {
        $groups = $this->normalizedGroups();
        $terms = collect($groups)->pluck('months')->flatten()->unique()->sort()->values()->all();

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
            'termGroups' => $groups,
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
