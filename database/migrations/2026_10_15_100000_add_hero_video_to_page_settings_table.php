<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->string('hero_video_desktop')->nullable()->after('hero_image_mobile');
            $table->string('hero_video_url', 1000)->nullable()->after('hero_video_desktop');
        });
    }

    public function down(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_video_desktop', 'hero_video_url']);
        });
    }
};
