<?php

namespace App\Filament\Resources\MotorcycleResource\Pages;

use App\Filament\Resources\MotorcycleResource;
use App\Models\Motorcycle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMotorcycle extends CreateRecord
{
    protected static string $resource = MotorcycleResource::class;

    protected function beforeCreate(): void
    {
        if (MotorcycleResource::ijaraMissingPlan($this->data)) {
            Notification::make()
                ->title('Switch on at least one Ijara plan')
                ->body('Or turn off "Available on Ijara plans" for this bike.')
                ->danger()
                ->send();

            $this->halt();
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['specs'] = Motorcycle::specsFromValues($data['spec_values'] ?? []);
        unset($data['spec_values']);

        return MotorcycleResource::ijaraDataForSave($data);
    }

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
