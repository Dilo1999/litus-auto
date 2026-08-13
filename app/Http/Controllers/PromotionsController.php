<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\View\View;

class PromotionsController extends Controller
{
    public function index(): View
    {
        $promotions = Motorcycle::query()
            ->where('is_published', true)
            ->where('has_promotion', true)
            ->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn (Motorcycle $motorcycle) => $motorcycle->discountAmount() > 0)
            ->values();

        $brands = $promotions->pluck('brand')->filter()->unique()->sort()->values();

        $featured = $promotions
            ->sortByDesc(fn (Motorcycle $motorcycle) => $motorcycle->discountAmount())
            ->first();

        $maxSave = $promotions->max(fn (Motorcycle $motorcycle) => $motorcycle->discountAmount()) ?: 0;
        $minPrice = $promotions->min(fn (Motorcycle $motorcycle) => (float) $motorcycle->sale_price) ?: 0;

        $stats = [
            'campaignCount' => $promotions->count(),
            'maxSave' => $maxSave,
            'minPrice' => $minPrice,
            'formattedMaxSave' => 'MVR ' . number_format($maxSave, 0),
            'formattedMinPrice' => 'MVR ' . number_format($minPrice, 0),
        ];

        return view('promotions', compact('promotions', 'brands', 'featured', 'stats'));
    }
}
