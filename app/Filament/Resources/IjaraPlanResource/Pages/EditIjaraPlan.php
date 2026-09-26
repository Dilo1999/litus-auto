<?php

namespace App\Filament\Resources\IjaraPlanResource\Pages;

use App\Filament\Resources\IjaraPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIjaraPlan extends EditRecord
{
    protected static string $resource = IjaraPlanResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Split the saved months into the two fixed lists (Plan A: 6 / 12 / 24, Plan B: 36 / 48).
        $groups = collect($this->getRecord()->normalizedGroups())->pluck('months', 'label');
        $data['term_groups'] = [
            ['months' => $groups->get('Plan A', [])],
            ['months' => $groups->get('Plan B', [])],
        ];

        return $data;
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
