<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Per plan: ['down' => down payment, 'months' => [month count => monthly lease]]
        Schema::table('motorcycles', function (Blueprint $table) {
            $table->json('ijara_rates')->nullable()->after('ijara_plans');
        });
    }

    public function down(): void
    {
        Schema::table('motorcycles', function (Blueprint $table) {
            $table->dropColumn('ijara_rates');
        });
    }
};
