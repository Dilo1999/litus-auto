<?php

namespace App\Filament\Resources\IjaraPlanResource\Pages;

use App\Filament\Resources\IjaraPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIjaraPlans extends ListRecords
{
    protected static string $resource = IjaraPlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add plan'),
        ];
    }
}
