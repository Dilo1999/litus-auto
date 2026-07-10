<?php

namespace App\Filament\Resources\ShowroomGalleryResource\Pages;

use App\Filament\Resources\ShowroomGalleryResource;
use App\Models\GalleryImage;
use Filament\Resources\Pages\CreateRecord;

class CreateShowroomGallery extends CreateRecord
{
    protected static string $resource = ShowroomGalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category'] = GalleryImage::CATEGORY_SHOWROOMS;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
