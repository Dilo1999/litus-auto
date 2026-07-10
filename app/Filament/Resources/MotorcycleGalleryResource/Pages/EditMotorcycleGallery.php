<?php

namespace App\Filament\Resources\MotorcycleGalleryResource\Pages;

use App\Filament\Resources\MotorcycleGalleryResource;
use App\Models\GalleryImage;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotorcycleGallery extends EditRecord
{
    protected static string $resource = MotorcycleGalleryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['category'] = GalleryImage::CATEGORY_MOTORCYCLES;

        return $data;
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
