<?php

namespace App\Filament\Resources\ShowroomGalleryResource\Pages;

use App\Filament\Resources\ShowroomGalleryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShowroomGallery extends ListRecords
{
    protected static string $resource = ShowroomGalleryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add showroom image'),
        ];
    }
}
