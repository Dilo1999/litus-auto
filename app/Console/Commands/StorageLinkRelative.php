<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StorageLinkRelative extends Command
{
    protected $signature = 'storage:link
                {--relative : Create the link using a relative path}
                {--force : Recreate existing storage links}';

    protected $description = 'Create the public/storage link (relative path, Windows/WAMP compatible)';

    public function handle(): int
    {
        $links = $this->laravel['config']['filesystems.links'] ?? [
            public_path('storage') => storage_path('app/public'),
        ];

        $useRelative = (bool) $this->option('relative') || PHP_OS_FAMILY === 'Windows';
        $force = (bool) $this->option('force');

        $failed = false;

        foreach ($links as $link => $target) {
            $linkPath = $this->pathString($link);
            $targetPath = $this->resolvePath($target);

            if (! is_dir($targetPath)) {
                File::ensureDirectoryExists($targetPath);
                $this->components->warn("Created missing target directory: {$targetPath}");
            }

            if ($this->linkPointsToTarget($linkPath, $targetPath)) {
                $this->components->info("The [{$linkPath}] link already points to [{$targetPath}].");
                continue;
            }

            if (file_exists($linkPath) && ! $force) {
                $this->components->error("The [{$linkPath}] path already exists. Run with --force to recreate it.");
                $failed = true;
                continue;
            }

            if (! $this->removeExistingLink($linkPath)) {
                $this->components->error("Could not remove existing path: {$linkPath}");
                $failed = true;
                continue;
            }

            if ($this->createLink($linkPath, $targetPath, $useRelative)) {
                $this->components->info("The [{$linkPath}] link has been connected to [{$targetPath}].");
                continue;
            }

            $this->components->error("Failed to create storage link for [{$linkPath}].");
            $failed = true;
        }

        return $failed ? self::FAILURE : self::SUCCESS;
    }

    private function pathString(string $path): string
    {
        return str_replace('\\', '/', $path);
    }

    private function resolvePath(string $path): string
    {
        $real = realpath($path);

        return $real ? str_replace('\\', '/', $real) : $this->pathString($path);
    }

    private function linkPointsToTarget(string $link, string $target): bool
    {
        if (! file_exists($link)) {
            return false;
        }

        $linkReal = realpath($link);
        $targetReal = realpath($target);

        return $linkReal && $targetReal && $linkReal === $targetReal;
    }

    private function removeExistingLink(string $link): bool
    {
        if (! file_exists($link)) {
            return true;
        }

        if (is_link($link)) {
            return @unlink($link);
        }

        if (PHP_OS_FAMILY === 'Windows' && is_dir($link)) {
            return @rmdir($link);
        }

        if (is_dir($link)) {
            return File::deleteDirectory($link);
        }

        return @unlink($link);
    }

    private function createLink(string $link, string $target, bool $useRelative): bool
    {
        if ($useRelative) {
            $relativeTarget = $this->getRelativePath(dirname($link), $target);

            if ($relativeTarget !== null && @symlink($relativeTarget, $link)) {
                return $this->linkPointsToTarget($link, $target);
            }
        }

        if (@symlink($target, $link)) {
            return $this->linkPointsToTarget($link, $target);
        }

        if (PHP_OS_FAMILY === 'Windows') {
            return $this->createWindowsJunction($link, $target);
        }

        return false;
    }

    private function createWindowsJunction(string $link, string $target): bool
    {
        $parent = dirname($link);

        if (! is_dir($parent)) {
            File::ensureDirectoryExists($parent);
        }

        $command = 'cmd /C mklink /J '
            .escapeshellarg(str_replace('/', '\\', $link)).' '
            .escapeshellarg(str_replace('/', '\\', $target));

        exec($command, $output, $exitCode);

        return $exitCode === 0 && $this->linkPointsToTarget($link, $target);
    }

    private function getRelativePath(string $from, string $to): ?string
    {
        $from = $this->pathString(rtrim($from, '/'));
        $to = $this->pathString(rtrim($to, '/'));

        $fromParts = explode('/', $from);
        $toParts = explode('/', $to);

        $commonLength = 0;
        $maxLength = min(count($fromParts), count($toParts));

        while ($commonLength < $maxLength && ($fromParts[$commonLength] ?? null) === ($toParts[$commonLength] ?? null)) {
            $commonLength++;
        }

        $upCount = count($fromParts) - $commonLength;
        $downParts = array_slice($toParts, $commonLength);

        if ($upCount === 0 && $downParts === []) {
            return '.';
        }

        $relative = str_repeat('../', $upCount).implode('/', $downParts);

        return $relative !== '' ? $relative : null;
    }
}
