<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\GalleryVideoResource;
use App\Filament\Resources\MotorcycleGalleryResource;
use App\Filament\Support\Stat;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;

class GalleryOverview extends GroupedStatsOverviewWidget
{
    protected static ?int $sort = 20;

    protected static ?string $heading = 'Gallery';

    protected static ?string $subheading = 'Photos & TikTok videos';

    protected function getCards(): array
    {
        $images = fn (string $category) => GalleryImage::where('category', $category);

        $bikeImgTotal = $images(GalleryImage::CATEGORY_MOTORCYCLES)->count();
        $bikeImgPub = $images(GalleryImage::CATEGORY_MOTORCYCLES)->where('is_published', true)->count();

        $videoTotal = GalleryVideo::count();
        $videoPub = GalleryVideo::where('is_published', true)->count();

        return [
            Stat::make('Motorcycle photos published', $bikeImgPub)
                ->description("of {$bikeImgTotal} total")
                ->icon('heroicon-s-photograph')
                ->tone('success')
                ->status($bikeImgTotal > 0 && $bikeImgPub === $bikeImgTotal ? 'All live' : ($bikeImgPub > 0 ? 'Partial' : 'None live'))
                ->progress($bikeImgTotal > 0 ? (int) round($bikeImgPub / $bikeImgTotal * 100) : 0)
                ->url(MotorcycleGalleryResource::getUrl('index')),
            Stat::make('TikTok videos published', $videoPub)
                ->description("of {$videoTotal} total")
                ->icon('heroicon-s-film')
                ->tone('info')
                ->status($videoTotal > 0 && $videoPub === $videoTotal ? 'All live' : ($videoPub > 0 ? 'Partial' : 'None live'))
                ->progress($videoTotal > 0 ? (int) round($videoPub / $videoTotal * 100) : 0)
                ->url(GalleryVideoResource::getUrl('index')),
        ];
    }
}
