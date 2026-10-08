<?php

namespace App\Filament\Widgets;

use App\Filament\Support\ContentInventory;
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

        $name = Filament::getUserName($user);
        $types = ContentInventory::types();
        $summary = ContentInventory::summary();

        $quickActions = collect(['motorcycles' => 'Add motorcycle', 'promotions' => 'New promotion', 'videos' => 'Add video', 'showrooms' => 'Add showroom'])
            ->filter(fn ($label, $key) => filled($types[$key]['createUrl'] ?? null))
            ->map(fn ($label, $key) => ['label' => $label, 'icon' => $types[$key]['icon'], 'url' => $types[$key]['createUrl']])
            ->values();

        return [
            'firstName' => str($name)->before(' ')->toString() ?: $name,
            'greeting' => $greeting,
            'today' => now()->format('l, j F Y'),
            'summary' => $summary,
            'attentionCount' => ContentInventory::attention()->count(),
            'runningPromos' => $types['promotions']['live'] ?? 0,
            'quickActions' => $quickActions,
        ];
    }
}
