<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
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

        $topRides = Motorcycle::query()
            ->where('is_published', true)
            ->where('is_top_selling', true)
            ->with(['colorVariants' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(4)
            ->get()
            ->map(function (Motorcycle $motorcycle) {
                $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
                $activePrice = $hasPromo
                    ? (float) $motorcycle->sale_price
                    : (float) $motorcycle->original_price;
                $monthly = $activePrice > 0
                    ? 'MVR ' . number_format((int) (round(($activePrice / 60) / 10) * 10))
                    : null;

                return [
                    'model' => $motorcycle->name,
                    'slug' => $motorcycle->slug,
                    'brand' => $motorcycle->brand,
                    'cc' => $motorcycle->engineCapacity() ?: '—',
                    'capacity' => $motorcycle->fuelTankCapacity() ?: '—',
                    'img' => $motorcycle->listImageUrl(),
                    'price' => $motorcycle->formattedOriginalPrice(),
                    'salePrice' => $hasPromo ? $motorcycle->formattedSalePrice() : null,
                    'discount' => $hasPromo ? $motorcycle->formattedDiscount() : null,
                    'hasPromotion' => $hasPromo,
                    'monthly' => $monthly,
                    'variant' => 'blue',
                    'badge' => 'Top seller',
                ];
            })
            ->all();

        $galleryImages = GalleryImage::query()
            ->published()
            ->featured()
            ->ofCategory(GalleryImage::CATEGORY_MOTORCYCLES)
            ->ordered()
            ->limit(8)
            ->get()
            ->map(fn (GalleryImage $image) => [
                'src' => $image->imageUrl(),
                'alt' => $image->title ?: 'Motorcycle gallery',
            ])
            ->all();

        return view('home', compact('promoMotorcycles', 'topRides', 'galleryImages'));
    }
}
