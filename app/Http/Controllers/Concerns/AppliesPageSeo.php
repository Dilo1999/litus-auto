<?php

namespace App\Http\Controllers\Concerns;

use App\Services\SeoService;

trait AppliesPageSeo
{
    protected function applySeo(string $routeName, array $defaults = [], array $replacements = []): void
    {
        app(SeoService::class)->applyForPage($routeName, $defaults, $replacements);
    }
}
