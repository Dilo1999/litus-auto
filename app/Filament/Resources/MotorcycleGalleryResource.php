<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\ManagesCategoryGalleryImages;
use App\Filament\Resources\MotorcycleGalleryResource\Pages;
use App\Models\GalleryImage;
use Filament\Resources\Resource;

class MotorcycleGalleryResource extends Resource
{
    use ManagesCategoryGalleryImages;

    protected static ?string $model = GalleryImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Gallery';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'gallery-motorcycles';

    public static function getCategory(): string
    {
        return GalleryImage::CATEGORY_MOTORCYCLES;
    }

    public static function getCategoryLabel(): string
    {
        return 'Motorcycles';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMotorcycleGallery::route('/'),
            'create' => Pages\CreateMotorcycleGallery::route('/create'),
            'edit' => Pages\EditMotorcycleGallery::route('/{record}/edit'),
        ];
    }
}
