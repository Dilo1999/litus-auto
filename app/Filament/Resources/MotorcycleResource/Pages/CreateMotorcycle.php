<?php

namespace App\Filament\Resources\MotorcycleResource\Pages;

use App\Filament\Resources\MotorcycleResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMotorcycle extends CreateRecord
{
    protected static string $resource = MotorcycleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }

    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Motorcycle created')
            ->body('Add color variants, 360° images, and gallery photos below.')
            ->success()
            ->send();
    }
}
