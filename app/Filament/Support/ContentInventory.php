<?php

namespace App\Filament\Support;

use App\Filament\Resources\GalleryVideoResource;
use App\Filament\Resources\IjaraPlanResource;
use App\Filament\Resources\MotorcycleGalleryResource;
use App\Filament\Resources\MotorcycleResource;
use App\Filament\Resources\PromotionResource;
use App\Filament\Resources\ShowroomResource;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\IjaraPlan;
use App\Models\Motorcycle;
use App\Models\Promotion;
use App\Models\Showroom;
use Illuminate\Support\Collection;

/**
 * Single source of truth for the dashboard: per-content-type totals, live counts
 * and links. Memoised per request so the hero, tiles and insights share one set of queries.
 */
class ContentInventory
{
    protected static ?array $types = null;

    /**
     * @return array<string, array{key: string, label: string, singular: string, icon: string, total: int, live: int, drafts: int, percent: int, note: ?string, url: string, createUrl: ?string}>
     */
    public static function types(): array
    {
        if (static::$types !== null) {
            return static::$types;
        }

        $photos = fn () => GalleryImage::where('category', GalleryImage::CATEGORY_MOTORCYCLES);

        $promoTotal = Promotion::count();
        $promoLive = Promotion::published()->currentlyActive()->count();

        $rows = [
            [
                'key' => 'motorcycles',
                'label' => 'Motorcycles',
                'singular' => 'motorcycle',
                'icon' => 'heroicon-o-truck',
                'total' => Motorcycle::count(),
                'live' => Motorcycle::where('is_published', true)->count(),
                'drafts' => Motorcycle::where('is_published', false)->count(),
                'note' => Motorcycle::where('is_published', true)->where('is_top_selling', true)->count().' top selling',
                'url' => MotorcycleResource::getUrl('index'),
                'createUrl' => MotorcycleResource::getUrl('create'),
            ],
            [
                'key' => 'promotions',
                'label' => 'Promotions',
                'singular' => 'promotion',
                'icon' => 'heroicon-o-tag',
                'total' => $promoTotal,
                'live' => $promoLive,
                'drafts' => Promotion::where('is_published', false)->count(),
                'note' => $promoLive > 0 ? 'running now' : 'none running',
                'url' => PromotionResource::getUrl('index'),
                'createUrl' => PromotionResource::getUrl('create'),
            ],
            [
                'key' => 'ijara',
                'label' => 'Ijara plans',
                'singular' => 'Ijara plan',
                'icon' => 'heroicon-o-clipboard-list',
                'total' => IjaraPlan::count(),
                'live' => IjaraPlan::where('is_published', true)->count(),
                'drafts' => IjaraPlan::where('is_published', false)->count(),
                'note' => null,
                'url' => IjaraPlanResource::getUrl('index'),
                'createUrl' => IjaraPlanResource::getUrl('create'),
            ],
            [
                'key' => 'photos',
                'label' => 'Photos',
                'singular' => 'photo',
                'icon' => 'heroicon-o-photograph',
                'total' => $photos()->count(),
                'live' => $photos()->where('is_published', true)->count(),
                'drafts' => $photos()->where('is_published', false)->count(),
                'note' => 'motorcycle gallery',
                'url' => MotorcycleGalleryResource::getUrl('index'),
                'createUrl' => null,
            ],
            [
                'key' => 'videos',
                'label' => 'TikTok videos',
                'singular' => 'video',
                'icon' => 'heroicon-o-film',
                'total' => GalleryVideo::count(),
                'live' => GalleryVideo::where('is_published', true)->count(),
                'drafts' => GalleryVideo::where('is_published', false)->count(),
                'note' => null,
                'url' => GalleryVideoResource::getUrl('index'),
                'createUrl' => GalleryVideoResource::getUrl('create'),
            ],
            [
                'key' => 'showrooms',
                'label' => 'Showrooms',
                'singular' => 'showroom',
                'icon' => 'heroicon-o-office-building',
                'total' => Showroom::count(),
                'live' => Showroom::where('is_published', true)->count(),
                'drafts' => Showroom::where('is_published', false)->count(),
                'note' => Showroom::where('is_published', true)->where('is_featured', true)->count().' featured',
                'url' => ShowroomResource::getUrl('index'),
                'createUrl' => ShowroomResource::getUrl('create'),
            ],
        ];

        return static::$types = collect($rows)
            ->map(fn (array $row) => $row + [
                'percent' => $row['total'] > 0 ? (int) round($row['live'] / $row['total'] * 100) : 0,
            ])
            ->keyBy('key')
            ->all();
    }

    /**
     * @return array{live: int, total: int, drafts: int, percent: int}
     */
    public static function summary(): array
    {
        $types = collect(static::types());
        $live = $types->sum('live');
        $total = $types->sum('total');

        return [
            'live' => $live,
            'total' => $total,
            'drafts' => $types->sum('drafts'),
            'percent' => $total > 0 ? (int) round($live / $total * 100) : 0,
        ];
    }

    /**
     * Actionable items, most important first.
     *
     * @return Collection<int, array{tone: string, icon: string, text: string, action: string, url: string}>
     */
    public static function attention(): Collection
    {
        $items = collect();

        $ending = Promotion::published()->currentlyActive()
            ->whereNotNull('ends_at')
            ->where('ends_at', '<=', now()->addDays(7))
            ->orderBy('ends_at')
            ->get();

        foreach ($ending as $promo) {
            $items->push([
                'tone' => 'warning',
                'icon' => 'heroicon-o-clock',
                'text' => "“{$promo->title}” ends {$promo->ends_at->diffForHumans()}",
                'action' => 'Extend',
                'url' => PromotionResource::getUrl('edit', ['record' => $promo]),
            ]);
        }

        $noImage = Motorcycle::where('is_published', true)
            ->where(fn ($q) => $q->whereNull('card_image')->orWhere('card_image', ''))
            ->count();

        if ($noImage > 0) {
            $items->push([
                'tone' => 'danger',
                'icon' => 'heroicon-o-photograph',
                'text' => $noImage === 1 ? '1 live motorcycle has no card image' : "{$noImage} live motorcycles have no card image",
                'action' => 'Fix',
                'url' => MotorcycleResource::getUrl('index'),
            ]);
        }

        foreach (static::types() as $type) {
            if ($type['drafts'] > 0) {
                $items->push([
                    'tone' => 'neutral',
                    'icon' => 'heroicon-o-eye-off',
                    'text' => $type['drafts'] === 1
                        ? "1 {$type['singular']} is unpublished"
                        : "{$type['drafts']} ".str($type['singular'])->plural().' are unpublished',
                    'action' => 'Review',
                    'url' => $type['url'],
                ]);
            }
        }

        if ($type = static::types()['promotions'] ?? null) {
            if ($type['live'] === 0) {
                $items->push([
                    'tone' => 'info',
                    'icon' => 'heroicon-o-tag',
                    'text' => 'No promotion is running on the storefront',
                    'action' => 'Create',
                    'url' => $type['createUrl'],
                ]);
            }
        }

        return $items;
    }

    /**
     * Latest edits across the catalogue.
     *
     * @return Collection<int, array{kind: string, icon: string, title: string, verb: string, at: \Illuminate\Support\Carbon, url: string}>
     */
    public static function recentActivity(int $limit = 6): Collection
    {
        $sources = [
            ['Motorcycle', 'heroicon-o-truck', Motorcycle::class, 'name', fn ($r) => MotorcycleResource::getUrl('edit', ['record' => $r])],
            ['Promotion', 'heroicon-o-tag', Promotion::class, 'title', fn ($r) => PromotionResource::getUrl('edit', ['record' => $r])],
            ['Ijara plan', 'heroicon-o-clipboard-list', IjaraPlan::class, 'name', fn ($r) => IjaraPlanResource::getUrl('edit', ['record' => $r])],
            ['Video', 'heroicon-o-film', GalleryVideo::class, 'title', fn ($r) => GalleryVideoResource::getUrl('edit', ['record' => $r])],
            ['Showroom', 'heroicon-o-office-building', Showroom::class, 'name', fn ($r) => ShowroomResource::getUrl('edit', ['record' => $r])],
        ];

        return collect($sources)
            ->flatMap(fn (array $s) => $s[2]::query()->latest('updated_at')->take($limit)->get()
                ->map(fn ($record) => [
                    'kind' => $s[0],
                    'icon' => $s[1],
                    'title' => method_exists($record, 'displayTitle')
                        ? $record->displayTitle()
                        : (filled($record->{$s[3]}) ? $record->{$s[3]} : "Untitled {$s[0]}"),
                    'verb' => $record->created_at && $record->updated_at && $record->created_at->eq($record->updated_at) ? 'added' : 'updated',
                    'at' => $record->updated_at,
                    'url' => $s[4]($record),
                ]))
            ->filter(fn (array $row) => $row['at'] !== null)
            ->sortByDesc('at')
            ->take($limit)
            ->values();
    }
}
