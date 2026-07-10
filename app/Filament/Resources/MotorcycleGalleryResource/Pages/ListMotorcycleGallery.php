<?php

namespace App\Filament\Resources\MotorcycleGalleryResource\Pages;

use App\Filament\Resources\MotorcycleGalleryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotorcycleGallery extends ListRecords
{
    protected static string $resource = MotorcycleGalleryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add motorcycle image'),
        ];
    }
}
