<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('page_label');
            $table->string('hero_image_desktop')->nullable();
            $table->string('hero_image_mobile')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        if (Schema::hasTable('page_seo') && Schema::hasColumn('page_seo', 'hero_image_desktop')) {
            $rows = DB::table('page_seo')
                ->where('route_name', '!=', 'motorcycle.show')
                ->get(['route_name', 'page_label', 'hero_image_desktop', 'hero_image_mobile', 'sort_order']);

            foreach ($rows as $row) {
                DB::table('page_settings')->insert([
                    'route_name' => $row->route_name,
                    'page_label' => $row->page_label,
                    'hero_image_desktop' => $row->hero_image_desktop,
                    'hero_image_mobile' => $row->hero_image_mobile,
                    'sort_order' => $row->sort_order,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Schema::table('page_seo', function (Blueprint $table) {
                $table->dropColumn(['hero_image_desktop', 'hero_image_mobile']);
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_settings')) {
            return;
        }

        if (Schema::hasTable('page_seo') && ! Schema::hasColumn('page_seo', 'hero_image_desktop')) {
            Schema::table('page_seo', function (Blueprint $table) {
                $table->string('hero_image_desktop')->nullable()->after('og_image');
                $table->string('hero_image_mobile')->nullable()->after('hero_image_desktop');
            });

            foreach (DB::table('page_settings')->get() as $row) {
                DB::table('page_seo')
                    ->where('route_name', $row->route_name)
                    ->update([
                        'hero_image_desktop' => $row->hero_image_desktop,
                        'hero_image_mobile' => $row->hero_image_mobile,
                    ]);
            }
        }

        Schema::dropIfExists('page_settings');
    }
};
