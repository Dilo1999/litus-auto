<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use App\Models\Motorcycle;
use Illuminate\View\View;

class PartsController extends Controller
{
    use AppliesPageSeo;

    public function __invoke(): View
    {
        $this->applySeo('parts');

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
