<?php

namespace App\Filament\Resources\MotorcycleResource\Pages;

use App\Filament\Resources\MotorcycleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotorcycles extends ListRecords
{
    protected static string $resource = MotorcycleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
