<?php

namespace App\Filament\Widgets;

use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\IjaraPlan;
use App\Models\Motorcycle;
use App\Models\Promotion;
use App\Models\Showroom;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;

class WelcomeBanner extends Widget
{
    protected static ?int $sort = 0;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.welcome-banner';

    protected function getViewData(): array
    {
        $user = Filament::auth()->user();

        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 12 => 'Good morning',
            $hour < 18 => 'Good afternoon',
            default => 'Good evening',
        };

        $liveCount = Motorcycle::where('is_published', true)->count()
            + Promotion::published()->currentlyActive()->count()
            + IjaraPlan::where('is_published', true)->count()
            + GalleryImage::where('is_published', true)->count()
            + GalleryVideo::where('is_published', true)->count()
            + Showroom::where('is_published', true)->count();

        $attentionCount = Motorcycle::where('is_published', false)->count()
            + Promotion::where('is_published', false)->count()
            + IjaraPlan::where('is_published', false)->count()
            + GalleryImage::where('is_published', false)->count()
            + GalleryVideo::where('is_published', false)->count()
            + Showroom::where('is_published', false)->count();

        $name = Filament::getUserName($user);
        $initials = collect(preg_split('/\s+/', trim($name)))
            ->filter()
            ->map(fn (string $part) => mb_substr($part, 0, 1))
            ->take(2)
            ->implode('');

        return [
            'name' => $name,
            'initials' => $initials !== '' ? mb_strtoupper($initials) : 'A',
            'greeting' => $greeting,
            'liveCount' => $liveCount,
            'attentionCount' => $attentionCount,
            'today' => now()->format('D j M'),
        ];
    }
}
