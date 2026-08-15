<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\View\View;

class PartsController extends Controller
{
    public function __invoke(): View
    {
        $brands = Motorcycle::query()
            ->where('is_published', true)
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->orderBy('brand')
            ->distinct()
            ->pluck('brand')
            ->values();

        return view('parts', compact('brands'));
    }
}
