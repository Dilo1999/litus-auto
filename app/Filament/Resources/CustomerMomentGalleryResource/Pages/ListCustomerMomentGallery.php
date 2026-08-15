<?php

namespace App\Filament\Resources\CustomerMomentGalleryResource\Pages;

use App\Filament\Concerns\ListsCategoryGalleryImages;
use App\Filament\Resources\CustomerMomentGalleryResource;
use Filament\Resources\Pages\ListRecords;

class ListCustomerMomentGallery extends ListRecords
{
    use ListsCategoryGalleryImages;

    protected static string $resource = CustomerMomentGalleryResource::class;

    protected static string $view = 'filament.resources.gallery-images.list-gallery';
}
