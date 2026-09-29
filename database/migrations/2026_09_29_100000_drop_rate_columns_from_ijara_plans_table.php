<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The payment calculator no longer applies a financial-charge rate (see the flat formula in
     * IjaraRates::calculatorData / resources/js/home.js: Plan A = price - advance, Plan B = price -
     * MVR 4,000 - advance, both divided by the term). These per-plan rate fields are unused.
     */
    public function up(): void
    {
        Schema::table('ijara_plans', function (Blueprint $table) {
            $table->dropColumn(['rate_plan_a', 'rate_plan_b']);
        });
    }

    public function down(): void
    {
        Schema::table('ijara_plans', function (Blueprint $table) {
            $table->decimal('rate_plan_a', 5, 2)->default(2.5);
            $table->decimal('rate_plan_b', 5, 2)->default(2.5);
        });
    }
};
