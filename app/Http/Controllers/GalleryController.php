<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::query()
            ->published()
            ->whereIn('category', [
                GalleryImage::CATEGORY_MOTORCYCLES,
                GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
            ])
            ->ordered()
            ->get();

        $allImages = $images
            ->map(fn (GalleryImage $image) => $image->toFrontendArray())
            ->values()
            ->all();

        $featuredPool = $images->where('is_featured', true)->values();

        // Prefer a balanced mix across categories, then shuffle and keep 5.
        $featuredMoments = collect([
            GalleryImage::CATEGORY_MOTORCYCLES,
            GalleryImage::CATEGORY_CUSTOMER_MOMENTS,
        ])
            ->flatMap(function (string $category) use ($featuredPool) {
                return $featuredPool->where('category', $category)->shuffle()->take(3);
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

        $customerMoments = $images
            ->where('category', GalleryImage::CATEGORY_CUSTOMER_MOMENTS)
            ->values()
            ->map(fn (GalleryImage $image) => $image->toFrontendArray())
            ->all();

        $catColors = [
            'Motorcycles' => '#E31E25',
            'Customer Moments' => '#16A34A',
        ];

        $momentCategories = ['All', 'Motorcycles', 'Customer Moments', 'Videos'];

        $heroFeatures = [
            ['icon' => 'bike', 'title' => 'Motorcycles', 'desc' => 'Adventure & street ride moments'],
            ['icon' => 'users', 'title' => 'Customer Moments', 'desc' => 'Real experiences from our riders'],
            ['icon' => 'images', 'title' => 'Full Gallery', 'desc' => 'Browse every published moment'],
        ];

        $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

        $videoUrl = 'https://www.tiktok.com/@litus.automobiles/video/7496836349077523719';
        $videoId = '7496836349077523719';
        $videoEmbedUrl = 'https://www.tiktok.com/player/v1/' . $videoId . '?autoplay=1';
        $videoThumb = Cache::remember('gallery.tiktok.thumbnail', now()->addHours(12), function () use ($videoUrl) {
            try {
                $response = Http::timeout(5)->get('https://www.tiktok.com/oembed', [
                    'url' => $videoUrl,
                ]);

                if ($response->successful()) {
                    return $response->json('thumbnail_url');
                }
            } catch (\Throwable) {
            }

            return null;
        }) ?? asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

        return view('gallery', compact(
            'allImages',
            'featuredMoments',
            'customerMoments',
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
