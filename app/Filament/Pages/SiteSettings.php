<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class SiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    protected static ?string $navigationGroup = 'Super Settings';

    protected static ?int $navigationSort = 90;

    protected static string $view = 'filament.pages.site-settings';

    public bool $maintenanceEnabled = false;

    public static function canAccess(): bool
    {
        $user = Auth::user();

        return $user instanceof User && $user->isSuperAdmin();
    }

    public function mount(): void
    {
        $this->maintenanceEnabled = SiteSetting::maintenanceEnabled();
    }

    public function updatedMaintenanceEnabled(bool $value): void
    {
        if (! SiteSetting::tableExists()) {
            $this->maintenanceEnabled = false;

            Notification::make()
                ->title('Database setup required')
                ->body('Run php artisan migrate on the server to enable maintenance mode.')
                ->danger()
                ->send();

            return;
        }

        SiteSetting::setMaintenanceEnabled($value);

        Notification::make()
            ->title($value ? 'Maintenance mode enabled' : 'Maintenance mode disabled')
            ->body($value
                ? 'The public website now shows the maintenance page. The admin panel remains accessible.'
                : 'The public website is live again.')
            ->success()
            ->send();
    }
}
