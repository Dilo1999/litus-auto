<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ShowroomResource;
use App\Models\Showroom;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class LocationsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 30;

    protected function getCards(): array
    {
        $total = Showroom::count();
        $published = Showroom::where('is_published', true)->count();
        $featured = Showroom::where('is_published', true)->where('is_featured', true)->count();

        return [
            Card::make('Locations · Showrooms & centres published', $published)
                ->description("of {$total} total · {$featured} featured")
                ->descriptionIcon('heroicon-s-office-building')
                ->color('success')
                ->url(ShowroomResource::getUrl('index')),
        ];
    }
}
