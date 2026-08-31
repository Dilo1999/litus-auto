<?php

namespace Database\Seeders;

use App\Models\PageSetting;
use Illuminate\Database\Seeder;

class PageSettingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PageSetting::pageDefinitions() as $routeName => $definition) {
            PageSetting::query()->updateOrCreate(
                ['route_name' => $routeName],
                [
                    'page_label' => $definition['label'],
                    'sort_order' => $definition['sort'],
                ]
            );
        }
    }
}
