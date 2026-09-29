<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ShowroomResource;
use App\Filament\Support\Stat;
use App\Models\Showroom;

class LocationsOverview extends GroupedStatsOverviewWidget
{
    protected static ?int $sort = 30;

    protected static ?string $heading = 'Locations';

    protected static ?string $subheading = 'Showrooms & service centres';

    protected function getCards(): array
    {
        $total = Showroom::count();
        $published = Showroom::where('is_published', true)->count();
        $featured = Showroom::where('is_published', true)->where('is_featured', true)->count();

        return [
            Stat::make('Showrooms & centres published', $published)
                ->description("of {$total} total · {$featured} featured")
                ->icon('heroicon-s-office-building')
                ->tone('success')
                ->status($total > 0 && $published === $total ? 'All live' : ($published > 0 ? 'Partial' : 'None live'))
                ->progress($total > 0 ? (int) round($published / $total * 100) : 0)
                ->url(ShowroomResource::getUrl('index')),
        ];
    }
}
