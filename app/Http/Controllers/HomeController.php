<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use App\Models\GalleryImage;
use App\Models\Motorcycle;
use App\Models\Showroom;
use Illuminate\View\View;

class HomeController extends Controller
{
    use AppliesPageSeo;

    public function index(): View
    {
        $this->applySeo('home');

        $promoMotorcycles = Motorcycle::query()
            ->where('is_published', true)
            ->onActivePromotion()
            ->with([
                'colorVariants' => fn ($q) => $q->orderBy('sort_order'),
                'promotions' => fn ($q) => $q->published()->currentlyActive()->ordered(),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn (Motorcycle $motorcycle) => $motorcycle->discountAmount() > 0)
            ->values();

        $topRides = Motorcycle::query()
            ->where('is_published', true)
            ->where('is_top_selling', true)
            ->with([
                'colorVariants' => fn ($q) => $q->orderBy('sort_order'),
                'promotions' => fn ($q) => $q->published()->currentlyActive()->ordered(),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(4)
            ->get()
            ->map(function (Motorcycle $motorcycle) {
                $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
                $activePrice = $hasPromo
                    ? $motorcycle->promotionalSalePrice()
                    : (float) $motorcycle->original_price;
                $monthly = $activePrice > 0
                    ? 'MVR ' . number_format((int) (round(($activePrice / 60) / 10) * 10))
                    : null;

                return [
                    'model' => $motorcycle->name,
                    'slug' => $motorcycle->slug,
                    'brand' => $motorcycle->brand,
                    'cc' => $motorcycle->engineCapacity() ?: '-',
                    'capacity' => $motorcycle->fuelTankCapacity() ?: '-',
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

        $showrooms = Showroom::query()
            ->published()
            ->ordered()
            ->get()
            ->map(fn (Showroom $showroom) => $showroom->toViewArray())
            ->all();

        $brands = Motorcycle::query()
            ->where('is_published', true)
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->orderBy('brand')
            ->distinct()
            ->pluck('brand')
            ->values();

        return view('home', compact('promoMotorcycles', 'topRides', 'galleryImages', 'showrooms', 'brands'));
    }
}
