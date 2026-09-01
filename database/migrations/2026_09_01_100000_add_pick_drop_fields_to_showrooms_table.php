<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('showrooms', function (Blueprint $table) {
            $table->boolean('offers_pick_drop')->default(false)->after('services');
            $table->string('pick_drop_label', 120)->nullable()->after('offers_pick_drop');
        });

        DB::table('showrooms')
            ->where('name', "Malé Showroom")
            ->update([
                'offers_pick_drop' => true,
                'pick_drop_label' => 'Malé',
            ]);

        DB::table('showrooms')
            ->where('name', 'Hulhumale Showroom')
            ->update([
                'offers_pick_drop' => true,
                'pick_drop_label' => 'Hulhumalé',
            ]);
    }

    public function down(): void
    {
        Schema::table('showrooms', function (Blueprint $table) {
            $table->dropColumn(['offers_pick_drop', 'pick_drop_label']);
        });
    }
};
