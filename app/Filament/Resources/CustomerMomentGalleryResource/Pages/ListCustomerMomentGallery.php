<?php

namespace App\Filament\Resources\CustomerMomentGalleryResource\Pages;

use App\Filament\Resources\CustomerMomentGalleryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerMomentGallery extends ListRecords
{
    protected static string $resource = CustomerMomentGalleryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add customer moment'),
        ];
    }
}
