<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('motorcycles', function (Blueprint $table) {
            $table->boolean('ijara_enabled')->default(true)->after('is_top_selling');
            $table->json('ijara_plans')->nullable()->after('ijara_enabled');
        });

        // Existing models keep today's behaviour: available on every plan.
        $slugs = Schema::hasTable('ijara_plans')
            ? DB::table('ijara_plans')->orderBy('sort_order')->pluck('slug')->all()
            : [];

        DB::table('motorcycles')->update(['ijara_plans' => json_encode($slugs)]);
    }

    public function down(): void
    {
        Schema::table('motorcycles', function (Blueprint $table) {
            $table->dropColumn(['ijara_enabled', 'ijara_plans']);
        });
    }
};
