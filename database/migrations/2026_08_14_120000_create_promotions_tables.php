<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('offer_note')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'starts_at', 'ends_at']);
        });

        Schema::create('promotion_motorcycle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motorcycle_id')->constrained()->cascadeOnDelete();
            $table->decimal('sale_price', 12, 2);
            $table->timestamps();

            $table->unique(['promotion_id', 'motorcycle_id']);
        });

        if (Schema::hasColumn('motorcycles', 'has_promotion')) {
            $promoBikes = DB::table('motorcycles')
                ->where('has_promotion', true)
                ->whereColumn('sale_price', '<', 'original_price')
                ->get(['id', 'sale_price', 'offer_note']);

            if ($promoBikes->isNotEmpty()) {
                $note = $promoBikes->first(fn ($bike) => filled($bike->offer_note))?->offer_note
                    ?: 'Limited-time campaign pricing. Save now and ride sooner on cash or Ijara terms.';

                $promotionId = DB::table('promotions')->insertGetId([
                    'title' => 'Current Campaign',
                    'offer_note' => $note,
                    'starts_at' => now()->startOfMonth(),
                    'ends_at' => now()->endOfMonth(),
                    'is_featured' => true,
                    'is_published' => true,
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($promoBikes as $bike) {
                    DB::table('promotion_motorcycle')->insert([
                        'promotion_id' => $promotionId,
                        'motorcycle_id' => $bike->id,
                        'sale_price' => $bike->sale_price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('promotion_motorcycle');
        Schema::dropIfExists('promotions');
    }
};
