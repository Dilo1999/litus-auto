<?php

namespace App\Filament\Widgets;

use App\Filament\Support\ContentInventory;
use Filament\Widgets\Widget;

class ContentPulse extends Widget
{
    protected static ?int $sort = 10;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.content-pulse';

    protected function getViewData(): array
    {
        return [
            'types' => array_values(ContentInventory::types()),
        ];
    }
}
