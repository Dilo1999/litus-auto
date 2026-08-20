<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Models\Showroom;
use Illuminate\View\View;

class MotorcycleController extends Controller
{
    public function index(): View
    {
        $motorcycles = Motorcycle::query()
            ->where('is_published', true)
            ->with([
                'colorVariants' => fn ($q) => $q->orderBy('sort_order'),
                'promotions' => fn ($q) => $q->published()->currentlyActive()->ordered(),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $brands = $motorcycles->pluck('brand')->filter()->unique()->sort()->values();
        $categories = $motorcycles->pluck('category')->filter()->unique()->sort()->values();
        $promoCount = $motorcycles->filter(fn (Motorcycle $motorcycle) => $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0)->count();

        return view('motorcycles', compact('motorcycles', 'brands', 'categories', 'promoCount'));
    }

    public function show(string $slug): View
    {
        $motorcycle = Motorcycle::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'colorVariants' => fn ($q) => $q->orderBy('sort_order'),
                'promotions' => fn ($q) => $q->published()->currentlyActive()->ordered(),
            ])
            ->firstOrFail();

        $defaultVariant = $motorcycle->defaultColorVariant();
        $hasSpinView = $motorcycle->hasSpinFrames();
        $spinImages = $hasSpinView ? $motorcycle->primarySpinFrameUrls() : [];
        $heroProductImage = $motorcycle->heroProductImageUrl();
        $galleryImages = $defaultVariant?->galleryImageUrls() ?? [];

        $related = Motorcycle::query()
            ->where('is_published', true)
            ->where('id', '!=', $motorcycle->id)
            ->with([
                'colorVariants' => fn ($q) => $q->orderBy('sort_order'),
                'promotions' => fn ($q) => $q->published()->currentlyActive()->ordered(),
            ])
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $showrooms = Showroom::query()
            ->published()
            ->ordered()
            ->pluck('name')
            ->all();

        return view('motorcycle-detail', [
            'motorcycle' => $motorcycle,
            'defaultVariant' => $defaultVariant,
            'spinImages' => $spinImages,
            'hasSpinView' => $hasSpinView,
            'heroProductImage' => $heroProductImage,
            'galleryImages' => $galleryImages,
            'spinByColor' => $motorcycle->spinFramesByColor(),
            'galleryByColor' => $motorcycle->galleryByColor(),
            'colors' => $motorcycle->colorVariants->map(fn ($v) => [
                'id' => $v->id,
                'label' => $v->label,
                'hex' => $v->hex_color,
            ])->all(),
            'related' => $related,
            'showrooms' => $showrooms,
        ]);
    }
}
