<?php

use App\Support\IjaraPlans;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ijara_plans', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('tag')->nullable();
            $table->string('color', 20)->default('#1257D6');
            $table->string('bg', 20)->default('#DCE8FF');
            $table->text('description')->nullable();
            $table->json('points')->nullable();
            $table->string('best_for')->nullable();
            $table->string('drawer_subtitle')->nullable();
            $table->text('full_description')->nullable();
            $table->json('benefits')->nullable();
            $table->text('eligibility')->nullable();
            $table->json('documents')->nullable();
            $table->text('who_for')->nullable();
            $table->text('important_note')->nullable();
            $table->json('terms')->nullable();
            $table->boolean('show_in_calculator')->default(true);
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed from the built-in content so the site looks identical until an admin edits it.
        foreach (IjaraPlans::defaults() as $index => $plan) {
            $isPremium = $plan['id'] === 'premium';

            DB::table('ijara_plans')->insert([
                'slug' => $plan['id'],
                'name' => $plan['name'],
                'tag' => $plan['tag'],
                'color' => $plan['color'],
                'bg' => $plan['bg'],
                'description' => $plan['desc'],
                'points' => json_encode($plan['pts']),
                'best_for' => $plan['best'],
                'drawer_subtitle' => $plan['drawer']['subtitle'],
                'full_description' => $plan['drawer']['fullDesc'],
                'benefits' => json_encode($plan['drawer']['benefits']),
                'eligibility' => $plan['drawer']['eligibility'],
                'documents' => json_encode($plan['drawer']['docs']),
                'who_for' => $plan['drawer']['whoFor'],
                'important_note' => $plan['drawer']['important'] ?? null,
                'terms' => json_encode($isPremium ? [6, 12] : [6, 12, 24, 36, 48]),
                'show_in_calculator' => ! $isPremium,
                'is_published' => true,
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ijara_plans');
    }
};
