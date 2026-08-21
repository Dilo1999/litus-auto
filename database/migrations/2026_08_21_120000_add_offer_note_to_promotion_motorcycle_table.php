<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promotion_motorcycle', function (Blueprint $table) {
            $table->string('offer_note', 100)->nullable()->after('sale_price');
        });

        $rows = DB::table('promotion_motorcycle')
            ->join('motorcycles', 'motorcycles.id', '=', 'promotion_motorcycle.motorcycle_id')
            ->leftJoin('promotions', 'promotions.id', '=', 'promotion_motorcycle.promotion_id')
            ->select([
                'promotion_motorcycle.id',
                'motorcycles.offer_note as motorcycle_note',
                'promotions.offer_note as promotion_note',
            ])
            ->get();

        foreach ($rows as $row) {
            $note = Str::limit(trim((string) ($row->motorcycle_note ?: $row->promotion_note ?: '')), 100, '');

            if ($note === '') {
                continue;
            }

            DB::table('promotion_motorcycle')
                ->where('id', $row->id)
                ->update(['offer_note' => $note]);
        }
    }

    public function down(): void
    {
        Schema::table('promotion_motorcycle', function (Blueprint $table) {
            $table->dropColumn('offer_note');
        });
    }
};
