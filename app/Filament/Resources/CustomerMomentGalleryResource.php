<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\ManagesCategoryGalleryImages;
use App\Filament\Resources\CustomerMomentGalleryResource\Pages;
use App\Models\GalleryImage;
use Filament\Resources\Resource;

class CustomerMomentGalleryResource extends Resource
{
    use ManagesCategoryGalleryImages;

    protected static ?string $model = GalleryImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gallery';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'gallery-customer-moments';

    public static function getCategory(): string
    {
        return GalleryImage::CATEGORY_CUSTOMER_MOMENTS;
    }

    public static function getCategoryLabel(): string
    {
        return 'Customer Moments';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerMomentGallery::route('/'),
            'create' => Pages\CreateCustomerMomentGallery::route('/create'),
            'edit' => Pages\EditCustomerMomentGallery::route('/{record}/edit'),
        ];
    }
}
