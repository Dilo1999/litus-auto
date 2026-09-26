<?php

namespace App\Filament\Resources\MotorcycleResource\Pages;

use App\Filament\Resources\MotorcycleResource;
use App\Models\Motorcycle;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotorcycle extends EditRecord
{
    protected static string $resource = MotorcycleResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['spec_values'] = Motorcycle::specValuesFromSpecs($data['specs'] ?? []);

        return MotorcycleResource::ijaraDataForForm($data);
    }

    protected function beforeSave(): void
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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['specs'] = Motorcycle::specsFromValues($data['spec_values'] ?? []);
        unset($data['spec_values']);

        return MotorcycleResource::ijaraDataForSave($data);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
