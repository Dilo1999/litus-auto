<?php

namespace App\Filament\Resources\ShowroomResource\Pages;

use App\Filament\Resources\ShowroomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShowrooms extends ListRecords
{
    protected static string $resource = ShowroomResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add showroom'),
        ];
    }
}
