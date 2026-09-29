<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\IjaraPlanResource;
use App\Filament\Resources\MotorcycleResource;
use App\Filament\Resources\PromotionResource;
use App\Filament\Support\Stat;
use App\Models\IjaraPlan;
use App\Models\Motorcycle;
use App\Models\Promotion;

class CatalogOverview extends GroupedStatsOverviewWidget
{
    protected static ?int $sort = 10;

    protected static ?string $heading = 'Catalog';

    protected static ?string $subheading = 'Motorcycles, promotions & Ijara plans';

    protected function getCards(): array
    {
        $bikesTotal = Motorcycle::count();
        $bikesPublished = Motorcycle::where('is_published', true)->count();
        $topSelling = Motorcycle::where('is_published', true)->where('is_top_selling', true)->count();

        $promoTotal = Promotion::count();
        $promoRunning = Promotion::published()->currentlyActive()->count();

        $plansTotal = IjaraPlan::count();
        $plansPublished = IjaraPlan::where('is_published', true)->count();

        return [
            Stat::make('Motorcycles published', $bikesPublished)
                ->description("of {$bikesTotal} total · {$topSelling} top selling")
                ->icon('heroicon-s-truck')
                ->tone('success')
                ->status($bikesTotal > 0 && $bikesPublished === $bikesTotal ? 'All live' : ($bikesPublished > 0 ? 'Partial' : 'None live'))
                ->progress($bikesTotal > 0 ? (int) round($bikesPublished / $bikesTotal * 100) : 0)
                ->url(MotorcycleResource::getUrl('index')),
            Stat::make('Running promotions', $promoRunning)
                ->description("of {$promoTotal} promotions")
                ->icon('heroicon-s-tag')
                ->tone($promoRunning > 0 ? 'warning' : 'neutral')
                ->status($promoRunning > 0 ? 'Active' : 'Idle')
                ->progress($promoTotal > 0 ? (int) round($promoRunning / $promoTotal * 100) : 0)
                ->url(PromotionResource::getUrl('index')),
            Stat::make('Ijara plans published', $plansPublished)
                ->description("of {$plansTotal} plans")
                ->icon('heroicon-s-clipboard-list')
                ->tone('primary')
                ->status($plansTotal > 0 && $plansPublished === $plansTotal ? 'All live' : ($plansPublished > 0 ? 'Partial' : 'None live'))
                ->progress($plansTotal > 0 ? (int) round($plansPublished / $plansTotal * 100) : 0)
                ->url(IjaraPlanResource::getUrl('index')),
        ];
    }
}
