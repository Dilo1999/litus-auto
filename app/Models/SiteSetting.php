<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'maintenance_enabled',
    ];

    protected $casts = [
        'maintenance_enabled' => 'boolean',
    ];

    public static function instance(): self
    {
        return Cache::rememberForever('site_settings.instance', function () {
            return static::query()->firstOrCreate([], [
                'maintenance_enabled' => false,
            ]);
        });
    }

    public static function maintenanceEnabled(): bool
    {
        return (bool) static::instance()->maintenance_enabled;
    }

    public static function setMaintenanceEnabled(bool $enabled): void
    {
        $setting = static::query()->firstOrCreate([], [
            'maintenance_enabled' => false,
        ]);

        $setting->update(['maintenance_enabled' => $enabled]);

        Cache::forget('site_settings.instance');
    }
}
