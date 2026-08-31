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

    public static function canViewAny(): bool
    {
        return (bool) config('gallery.customer_moments_visible', false);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerMomentGallery::route('/'),
        ];
    }
}
