<?php

namespace App\Console\Commands;

use App\Support\StorageDirectories;
use Illuminate\Console\Command;

class EnsureStorageDirectoriesCommand extends Command
{
    protected $signature = 'storage:ensure-directories';

    protected $description = 'Create required storage folders for Livewire uploads and motorcycle images (cPanel)';

    public function handle(): int
    {
        StorageDirectories::ensure();

        foreach (StorageDirectories::required() as $directory) {
            $exists = is_dir($directory) ? 'OK' : 'MISSING';
            $writable = is_writable($directory) ? 'writable' : 'not writable';
            $this->line("{$exists} ({$writable}): {$directory}");
        }

        $this->newLine();
        $this->info('Done. If any folder is not writable, set storage/ to 755 or 775 in cPanel File Manager.');

        return self::SUCCESS;
    }
}
