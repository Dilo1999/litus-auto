<?php

namespace App\Services;

use App\Models\PageSeo;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class SeoService
{
    protected string $defaultOgImage;

    public function __construct()
    {
        $this->defaultOgImage = asset('images/homepage/Website-Banner-mobile-1.webp');
    }

    /**
     * Apply SEO for a page. Uses admin-configured PageSeo when available,
     * otherwise falls back to provided defaults.
     *
     * @param  array<string, mixed>  $defaults
     * @param  array<string, string>  $replacements
     */
    public function applyForPage(string $routeName, array $defaults = [], array $replacements = []): void
    {
        $pageSeo = PageSeo::forRoute($routeName);
        $url = url()->current();

        $configured = $pageSeo?->applyPlaceholders($replacements) ?? [];

        $metaTitle = $this->resolveValue(
            $configured['meta_title'] ?? null,
            $defaults['meta_title'] ?? null,
            $replacements
        );
        $metaDesc = $this->resolveValue(
            $configured['meta_description'] ?? null,
            $defaults['meta_description'] ?? null,
            $replacements
        );

        $ogImage = $pageSeo?->og_image_url
            ?? $defaults['og_image']
            ?? $this->homeShareImage()
            ?? $this->defaultOgImage;

        $canonical = $defaults['canonical'] ?? $url;
        $robots = $pageSeo?->robots;

        if ($metaTitle) {
            SEOMeta::setTitle($metaTitle, false);
        }
        if ($metaDesc) {
            SEOMeta::setDescription($metaDesc);
        }
        SEOMeta::setCanonical($canonical);
        if ($robots) {
            SEOMeta::setRobots($robots);
        }

        OpenGraph::setTitle($metaTitle ?: config('app.name'));
        if ($metaDesc) {
            OpenGraph::setDescription($metaDesc);
        }
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('site_name', 'LITUS Automobiles');
        OpenGraph::addImage($ogImage);

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle($metaTitle ?: config('app.name'));
        if ($metaDesc) {
            TwitterCard::setDescription($metaDesc);
        }
        TwitterCard::setImage($ogImage);
    }

    protected function homeShareImage(): ?string
    {
        return PageSeo::forRoute('home')?->og_image_url;
    }

    protected function resolveValue(?string $configured, ?string $fallback, array $replacements): ?string
    {
        $value = filled($configured) ? $configured : $fallback;

        return PageSeo::replacePlaceholders($value, $replacements);
    }
}
