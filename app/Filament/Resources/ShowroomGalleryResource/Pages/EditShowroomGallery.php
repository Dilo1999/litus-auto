<?php

namespace App\Filament\Resources\ShowroomGalleryResource\Pages;

use App\Filament\Resources\ShowroomGalleryResource;
use App\Models\GalleryImage;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShowroomGallery extends EditRecord
{
    protected static string $resource = ShowroomGalleryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['category'] = GalleryImage::CATEGORY_SHOWROOMS;

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
