<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\IjaraPlanResource;
use App\Filament\Resources\MotorcycleResource;
use App\Filament\Resources\PromotionResource;
use App\Models\IjaraPlan;
use App\Models\Motorcycle;
use App\Models\Promotion;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CatalogOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 10;

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
            Card::make('Catalog · Motorcycles published', $bikesPublished)
                ->description("of {$bikesTotal} total · {$topSelling} top selling")
                ->descriptionIcon('heroicon-s-truck')
                ->color('success')
                ->url(MotorcycleResource::getUrl('index')),
            Card::make('Catalog · Running promotions', $promoRunning)
                ->description("of {$promoTotal} promotions")
                ->descriptionIcon('heroicon-s-tag')
                ->color($promoRunning > 0 ? 'warning' : 'secondary')
                ->url(PromotionResource::getUrl('index')),
            Card::make('Catalog · Ijara plans published', $plansPublished)
                ->description("of {$plansTotal} plans")
                ->descriptionIcon('heroicon-s-clipboard-list')
                ->color('primary')
                ->url(IjaraPlanResource::getUrl('index')),
        ];
    }
}
