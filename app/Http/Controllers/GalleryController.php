<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::query()
            ->published()
            ->ordered()
            ->get();

        $allImages = $images
            ->map(fn (GalleryImage $image) => $image->toFrontendArray())
            ->values()
            ->all();

        $featuredPool = $images->where('is_featured', true)->values();

        // Prefer a balanced mix across the three categories, then shuffle and keep 5.
        $featuredMoments = collect([
            GalleryImage::CATEGORY_MOTORCYCLES,
            GalleryImage::CATEGORY_SHOWROOMS,
            GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
        ])
            ->flatMap(function (string $category) use ($featuredPool) {
                return $featuredPool->where('category', $category)->shuffle()->take(2);
            })
            ->unique('id')
            ->shuffle()
            ->take(5)
            ->values()
            ->map(fn (GalleryImage $image) => $image->toFeaturedArray())
            ->all();

        // If fewer than 5 after balancing, fill from remaining featured images.
        if (count($featuredMoments) < 5) {
            $selectedIds = collect($featuredMoments)->pluck('id')->all();
            $extra = $featuredPool
                ->reject(fn (GalleryImage $image) => in_array($image->id, $selectedIds, true))
                ->shuffle()
                ->take(5 - count($featuredMoments))
                ->map(fn (GalleryImage $image) => $image->toFeaturedArray())
                ->all();

            $featuredMoments = array_values(array_merge($featuredMoments, $extra));
            shuffle($featuredMoments);
        }

        $catColors = [
            'Motorcycles' => '#E31E25',
            'Showroom' => '#7C3AED',
            'Customer Moments' => '#16A34A',
        ];

        $momentCategories = ['All', 'Motorcycles', 'Showrooms', 'Customer Moments', 'Videos'];

        $heroFeatures = [
            ['icon' => 'bike', 'title' => 'Motorcycles', 'desc' => 'Adventure & street ride moments'],
            ['icon' => 'eye', 'title' => 'Showroom', 'desc' => 'Premium display & launch highlights'],
            ['icon' => 'users', 'title' => 'Customer Moments', 'desc' => 'Real experiences from our riders'],
            ['icon' => 'images', 'title' => 'Full Gallery', 'desc' => 'Browse every published moment'],
        ];

        $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));
        $videoId = 'o8grf3wSwQU';
        $videoEmbedUrl = 'https://www.youtube-nocookie.com/embed/' . $videoId . '?autoplay=1&rel=0';
        $videoThumb = 'https://img.youtube.com/vi/' . $videoId . '/maxresdefault.jpg';

        return view('gallery', compact(
            'allImages',
            'featuredMoments',
            'catColors',
            'momentCategories',
            'heroFeatures',
            'heroBg',
            'videoId',
            'videoEmbedUrl',
            'videoThumb',
        ));
    }
}
