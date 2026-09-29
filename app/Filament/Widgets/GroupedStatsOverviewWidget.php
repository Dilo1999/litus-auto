<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;

abstract class GroupedStatsOverviewWidget extends StatsOverviewWidget
{
    protected static string $view = 'filament.widgets.grouped-stats-overview';

    protected static ?string $heading = null;

    protected static ?string $subheading = null;

    protected function getViewData(): array
    {
        return [
            'heading' => static::$heading,
            'subheading' => static::$subheading,
            'columns' => $this->getColumns(),
            'cards' => $this->getCachedCards(),
        ];
    }
}
