<?php

namespace App\Filament\Resources\CustomerMomentGalleryResource\Pages;

use App\Filament\Resources\CustomerMomentGalleryResource;
use App\Models\GalleryImage;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerMomentGallery extends EditRecord
{
    protected static string $resource = CustomerMomentGalleryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['category'] = GalleryImage::CATEGORY_CUSTOMER_MOMENTS;

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
