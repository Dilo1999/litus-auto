<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteMaintenance
{
    /**
     * @var array<int, string>
     */
    protected array $except = [
        'admin',
        'admin/*',
        'filament',
        'filament/*',
        'livewire',
        'livewire/*',
        'storage',
        'storage/*',
        'build',
        'build/*',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! SiteSetting::maintenanceEnabled()) {
            return $next($request);
        }

        if ($this->inExceptArray($request)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'The website is temporarily unavailable while we perform maintenance.',
            ], 503);
        }

        return response()->view('maintenance', [], 503);
    }

    protected function inExceptArray(Request $request): bool
    {
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }
}
