<?php

namespace App\Support;

class StorageDirectories
{
    /**
     * @return list<string>
     */
    public static function required(): array
    {
        return [
            storage_path('app/livewire-tmp'),
            storage_path('app/public/motorcycles/cards'),
            storage_path('app/public/motorcycles/spin'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
        ];
    }

    public static function ensure(): void
    {
        foreach (self::required() as $directory) {
            if (is_dir($directory)) {
                continue;
            }

            mkdir($directory, 0755, true);
        }
    }
}
