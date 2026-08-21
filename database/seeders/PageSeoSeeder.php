<?php

namespace Database\Seeders;

use App\Models\PageSeo;
use Illuminate\Database\Seeder;

class PageSeoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PageSeo::pageDefinitions() as $routeName => $definition) {
            PageSeo::query()->updateOrCreate(
                ['route_name' => $routeName],
                [
                    'page_label' => $definition['label'],
                    'meta_title' => $definition['defaults']['meta_title'] ?? null,
                    'meta_description' => $definition['defaults']['meta_description'] ?? null,
                    'og_image' => $routeName === 'home' ? null : null,
                    'robots' => PageSeo::ROBOTS_INDEX,
                    'sort_order' => $definition['sort'],
                ]
            );
        }
    }
}
