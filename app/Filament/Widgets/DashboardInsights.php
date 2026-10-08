<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\MotorcycleResource;
use App\Filament\Support\ContentInventory;
use App\Models\Motorcycle;
use Filament\Widgets\Widget;

class DashboardInsights extends Widget
{
    protected static ?int $sort = 20;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.dashboard-insights';

    protected function getViewData(): array
    {
        $bikes = Motorcycle::query()
            ->latest('created_at')
            ->take(4)
            ->get()
            ->map(fn (Motorcycle $bike) => [
                'name' => $bike->name,
                'brand' => $bike->brand,
                'image' => $bike->cardImageUrl(),
                'price' => $bike->original_price ? $bike->formattedSalePrice() : null,
                'live' => (bool) $bike->is_published,
                'topSelling' => (bool) $bike->is_top_selling,
                'url' => MotorcycleResource::getUrl('edit', ['record' => $bike]),
            ]);

        return [
            'bikes' => $bikes,
            'bikesUrl' => MotorcycleResource::getUrl('index'),
            'attention' => ContentInventory::attention()->take(5),
            'activity' => ContentInventory::recentActivity(6),
        ];
    }
}
