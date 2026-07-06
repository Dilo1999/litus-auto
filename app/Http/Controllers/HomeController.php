<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $promoMotorcycles = Motorcycle::query()
            ->where('is_published', true)
            ->where('has_promotion', true)
            ->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn (Motorcycle $motorcycle) => $motorcycle->discountAmount() > 0)
            ->values();

        return view('home', compact('promoMotorcycles'));
    }
}
