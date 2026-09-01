<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use AppliesPageSeo;

    public function index(): View
    {
        $this->applySeo('gallery');

        $showCustomerMoments = (bool) config('gallery.customer_moments_visible', false);

        $images = GalleryImage::query()
            ->published()
            ->whereIn('category', array_values(array_filter([
                GalleryImage::CATEGORY_MOTORCYCLES,
                $showCustomerMoments ? GalleryImage::CATEGORY_CUSTOMER_MOMENTS : null,
            ])))
            ->ordered()
            ->get();

        $allImages = $images
            ->map(fn (GalleryImage $image) => $image->toFrontendArray())
            ->values()
            ->all();

        $featuredPool = $images->where('is_featured', true)->values();

        $featuredCategories = array_values(array_filter([
            GalleryImage::CATEGORY_MOTORCYCLES,
            $showCustomerMoments ? GalleryImage::CATEGORY_CUSTOMER_MOMENTS : null,
        ]));

        $featuredMoments = collect($featuredCategories)
            ->flatMap(function (string $category) use ($featuredPool) {
                return $featuredPool->where('category', $category)->shuffle()->take(3);
            })
            ->unique('id')
            ->shuffle()
            ->take(5)
            ->values()
            ->map(fn (GalleryImage $image) => $image->toFeaturedArray())
            ->all();

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

        $catColors = array_filter([
            'Motorcycles' => '#E31E25',
            'Customer Moments' => $showCustomerMoments ? '#16A34A' : null,
        ], fn ($color) => $color !== null);

        $momentCategories = array_values(array_filter([
            'All',
            'Motorcycles',
            $showCustomerMoments ? 'Customer Moments' : null,
            'Videos',
        ]));

        $heroFeatures = array_values(array_filter([
            ['icon' => 'bike', 'title' => 'Motorcycles', 'desc' => 'Adventure & street ride moments'],
            $showCustomerMoments
                ? ['icon' => 'users', 'title' => 'Customer Moments', 'desc' => 'Real experiences from our riders']
                : null,
            ['icon' => 'images', 'title' => 'Full Gallery', 'desc' => 'Browse every published moment'],
        ]));

        $galleryVideos = GalleryVideo::query()
            ->published()
            ->ordered()
            ->get()
            ->map(fn (GalleryVideo $video) => $video->toFrontendArray())
            ->filter(fn (array $video) => filled($video['embed_url']))
            ->values()
            ->all();

        return view('gallery', compact(
            'allImages',
            'featuredMoments',
            'customerMoments',
            'catColors',
            'momentCategories',
            'heroFeatures',
            'galleryVideos',
            'showCustomerMoments',
        ));
    }
}
