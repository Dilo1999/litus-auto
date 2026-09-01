<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('showrooms', function (Blueprint $table) {
            if (Schema::hasColumn('showrooms', 'offers_pick_drop')) {
                $table->dropColumn('offers_pick_drop');
            }

            if (Schema::hasColumn('showrooms', 'pick_drop_label')) {
                $table->dropColumn('pick_drop_label');
            }
        });
    }

    public function down(): void
    {
        Schema::table('showrooms', function (Blueprint $table) {
            $table->boolean('offers_pick_drop')->default(false)->after('services');
            $table->string('pick_drop_label', 120)->nullable()->after('offers_pick_drop');
        });
    }
};
