<?php

namespace App\Filament\Resources\MotorcycleGalleryResource\Pages;

use App\Filament\Resources\MotorcycleGalleryResource;
use App\Models\GalleryImage;
use Filament\Resources\Pages\CreateRecord;

class CreateMotorcycleGallery extends CreateRecord
{
    protected static string $resource = MotorcycleGalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category'] = GalleryImage::CATEGORY_MOTORCYCLES;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
