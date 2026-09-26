<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Financial charge rate (% per month, flat) for each option of a plan. Default 2.5%.
        Schema::table('ijara_plans', function (Blueprint $table) {
            $table->decimal('rate_plan_a', 5, 2)->default(2.5)->after('term_groups');
            $table->decimal('rate_plan_b', 5, 2)->default(2.5)->after('rate_plan_a');
        });
    }

    public function down(): void
    {
        Schema::table('ijara_plans', function (Blueprint $table) {
            $table->dropColumn(['rate_plan_a', 'rate_plan_b']);
        });
    }
};
