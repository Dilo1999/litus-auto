<?php

namespace App\Providers;

use App\Mail\Transport\BrevoTransport;
use App\Support\StorageDirectories;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StorageLinkCommand::class, function () {
            return $this->app->make(\App\Console\Commands\StorageLinkRelative::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // MySQL (e.g. MariaDB / older MySQL) has a 1000-byte index limit with utf8mb4.
        // Default string length 191 keeps unique indexes under that limit.
        Schema::defaultStringLength(191);

        StorageDirectories::ensure();

        Mail::extend('brevo', function (array $config = []) {
            return new BrevoTransport(
                (string) ($config['key'] ?? config('services.brevo.key')),
                filter_var(
                    $config['verify_ssl'] ?? config('services.brevo.verify_ssl', true),
                    FILTER_VALIDATE_BOOLEAN
                ),
            );
        });

        // Use current request origin for storage URLs so Filament file previews
        // work without CORS (e.g. when using 127.0.0.1:8000 vs localhost).
        if (! $this->app->runningInConsole() && $this->app->request?->getHost()) {
            $url = $this->app->request->getSchemeAndHttpHost();
            config(['filesystems.disks.public.url' => $url.'/storage']);
        }
    }
}
