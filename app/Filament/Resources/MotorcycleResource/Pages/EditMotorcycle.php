<?php

namespace App\Filament\Resources\MotorcycleResource\Pages;

use App\Filament\Resources\MotorcycleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotorcycle extends EditRecord
{
    protected static string $resource = MotorcycleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
