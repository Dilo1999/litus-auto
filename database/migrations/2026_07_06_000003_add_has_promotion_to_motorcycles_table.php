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
            $table->boolean('has_promotion')->default(false)->after('original_price');
        });

        DB::table('motorcycles')
            ->whereColumn('sale_price', '<', 'original_price')
            ->update(['has_promotion' => true]);
    }

    public function down(): void
    {
        Schema::table('motorcycles', function (Blueprint $table) {
            $table->dropColumn('has_promotion');
        });
    }
};
