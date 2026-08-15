<?php

namespace App\Filament\Resources\MotorcycleGalleryResource\Pages;

use App\Filament\Concerns\ListsCategoryGalleryImages;
use App\Filament\Resources\MotorcycleGalleryResource;
use Filament\Resources\Pages\ListRecords;

class ListMotorcycleGallery extends ListRecords
{
    use ListsCategoryGalleryImages;

    protected static string $resource = MotorcycleGalleryResource::class;

    protected static string $view = 'filament.resources.gallery-images.list-gallery';
}
