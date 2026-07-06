<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\View\View;

class MotorcycleController extends Controller
{
    public function index(): View
    {
        $motorcycles = Motorcycle::query()
            ->where('is_published', true)
            ->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $brands = $motorcycles->pluck('brand')->filter()->unique()->sort()->values();

        return view('motorcycles', compact('motorcycles', 'brands'));
    }

    public function show(string $slug): View
    {
        $motorcycle = Motorcycle::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')])
            ->firstOrFail();

        $defaultVariant = $motorcycle->defaultColorVariant();
        $spinImages = $defaultVariant?->spinFrameUrls() ?? [];
        $galleryImages = $defaultVariant?->galleryImageUrls() ?? [];

        $related = Motorcycle::query()
            ->where('is_published', true)
            ->where('id', '!=', $motorcycle->id)
            ->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->limit(3)
            ->get()
            ->map(function (Motorcycle $item) {
                $variant = $item->defaultColorVariant();
                $gallery = $variant?->galleryImageUrls() ?? [];
                $spin = $variant?->spinFrameUrls() ?? [];

                return [
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'discount' => $item->hasPromotion() && $item->discountAmount() > 0
                        ? $item->formattedDiscount()
                        : null,
                    'img' => $gallery[0] ?? $spin[0] ?? '',
                ];
            });

        return view('motorcycle-detail', [
            'motorcycle' => $motorcycle,
            'defaultVariant' => $defaultVariant,
            'spinImages' => $spinImages,
            'galleryImages' => $galleryImages,
            'spinByColor' => $motorcycle->spinFramesByColor(),
            'galleryByColor' => $motorcycle->galleryByColor(),
            'colors' => $motorcycle->colorVariants->map(fn ($v) => [
                'id' => $v->id,
                'label' => $v->label,
                'hex' => $v->hex_color,
            ])->all(),
            'related' => $related,
        ]);
    }
}
