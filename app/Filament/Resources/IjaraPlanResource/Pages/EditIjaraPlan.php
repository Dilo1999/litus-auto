<?php

namespace App\Filament\Resources\IjaraPlanResource\Pages;

use App\Filament\Resources\IjaraPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIjaraPlan extends EditRecord
{
    protected static string $resource = IjaraPlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
