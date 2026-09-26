<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\GalleryVideoResource;
use App\Filament\Resources\MotorcycleGalleryResource;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class GalleryOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 20;

    protected function getCards(): array
    {
        $images = fn (string $category) => GalleryImage::where('category', $category);

        $bikeImgTotal = $images(GalleryImage::CATEGORY_MOTORCYCLES)->count();
        $bikeImgPub = $images(GalleryImage::CATEGORY_MOTORCYCLES)->where('is_published', true)->count();

        $videoTotal = GalleryVideo::count();
        $videoPub = GalleryVideo::where('is_published', true)->count();

        return [
            Card::make('Gallery · Motorcycle photos published', $bikeImgPub)
                ->description("of {$bikeImgTotal} total")
                ->descriptionIcon('heroicon-s-photograph')
                ->color('success')
                ->url(MotorcycleGalleryResource::getUrl('index')),
            Card::make('Gallery · TikTok videos published', $videoPub)
                ->description("of {$videoTotal} total")
                ->descriptionIcon('heroicon-s-film')
                ->color('danger')
                ->url(GalleryVideoResource::getUrl('index')),
        ];
    }
}
