<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = [
        'maintenance_enabled',
    ];

    protected $casts = [
        'maintenance_enabled' => 'boolean',
    ];

    public static function tableExists(): bool
    {
        try {
            return Schema::hasTable('site_settings');
        } catch (\Throwable) {
            return false;
        }
    }

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
        if (! static::tableExists()) {
            return false;
        }

        try {
            return (bool) static::instance()->maintenance_enabled;
        } catch (\Throwable) {
            return false;
        }
    }

    public static function setMaintenanceEnabled(bool $enabled): void
    {
        if (! static::tableExists()) {
            return;
        }

        $setting = static::query()->firstOrCreate([], [
            'maintenance_enabled' => false,
        ]);

        $setting->update(['maintenance_enabled' => $enabled]);

        Cache::forget('site_settings.instance');
    }
}
