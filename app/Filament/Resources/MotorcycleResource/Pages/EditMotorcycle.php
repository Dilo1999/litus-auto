<?php

namespace App\Filament\Resources\MotorcycleResource\Pages;

use App\Filament\Resources\MotorcycleResource;
use App\Models\Motorcycle;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotorcycle extends EditRecord
{
    protected static string $resource = MotorcycleResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['spec_values'] = Motorcycle::specValuesFromSpecs($data['specs'] ?? []);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['specs'] = Motorcycle::specsFromValues($data['spec_values'] ?? []);
        unset($data['spec_values']);

        return $data;
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
