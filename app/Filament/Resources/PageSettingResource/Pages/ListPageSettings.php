<?php

namespace App\Filament\Resources\PageSettingResource\Pages;

use App\Filament\Resources\PageSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListPageSettings extends ListRecords
{
    protected static string $resource = PageSettingResource::class;

    protected function getTitle(): string
    {
        return 'Page Settings';
    }
}
