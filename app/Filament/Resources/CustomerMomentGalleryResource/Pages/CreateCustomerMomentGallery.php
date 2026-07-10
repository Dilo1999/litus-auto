<?php

namespace App\Filament\Resources\CustomerMomentGalleryResource\Pages;

use App\Filament\Resources\CustomerMomentGalleryResource;
use App\Models\GalleryImage;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerMomentGallery extends CreateRecord
{
    protected static string $resource = CustomerMomentGalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category'] = GalleryImage::CATEGORY_CUSTOMER_MOMENTS;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
