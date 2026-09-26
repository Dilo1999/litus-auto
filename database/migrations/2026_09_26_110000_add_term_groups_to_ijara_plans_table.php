<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Each plan can offer several options (Plan A, Plan B ...), each with its own months.
        // `terms` stays as the combined list of every month across the options.
        Schema::table('ijara_plans', function (Blueprint $table) {
            $table->json('term_groups')->nullable()->after('terms');
        });

        foreach (DB::table('ijara_plans')->get(['id', 'terms']) as $plan) {
            DB::table('ijara_plans')->where('id', $plan->id)->update([
                'term_groups' => json_encode([['label' => 'Plan A', 'months' => json_decode($plan->terms ?? '[]', true)]]),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('ijara_plans', function (Blueprint $table) {
            $table->dropColumn('term_groups');
        });
    }
};
