<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_seo', function (Blueprint $table) {
            $table->string('hero_image_desktop')->nullable()->after('og_image');
            $table->string('hero_image_mobile')->nullable()->after('hero_image_desktop');
        });
    }

    public function down(): void
    {
        Schema::table('page_seo', function (Blueprint $table) {
            $table->dropColumn(['hero_image_desktop', 'hero_image_mobile']);
        });
    }
};
