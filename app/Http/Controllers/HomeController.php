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
            ->limit(6)
            ->get()
            ->map(fn (Motorcycle $motorcycle) => [
                'model' => $motorcycle->name,
                'slug' => $motorcycle->slug,
                'cc' => $motorcycle->engineCapacity() ?: '—',
                'capacity' => $motorcycle->fuelTankCapacity() ?: '—',
                'img' => $motorcycle->listImageUrl(),
                'variant' => 'blue',
                'badge' => '★ Best Seller',
            ])
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
