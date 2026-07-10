<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\ManagesCategoryGalleryImages;
use App\Filament\Resources\ShowroomGalleryResource\Pages;
use App\Models\GalleryImage;
use Filament\Resources\Resource;

class ShowroomGalleryResource extends Resource
{
    use ManagesCategoryGalleryImages;

    protected static ?string $model = GalleryImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationGroup = 'Gallery';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'gallery-showrooms';

    public static function getCategory(): string
    {
        return GalleryImage::CATEGORY_SHOWROOMS;
    }

    public static function getCategoryLabel(): string
    {
        return 'Showrooms';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShowroomGallery::route('/'),
            'create' => Pages\CreateShowroomGallery::route('/create'),
            'edit' => Pages\EditShowroomGallery::route('/{record}/edit'),
        ];
    }
}
