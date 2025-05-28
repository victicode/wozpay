<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('price');
            $table->integer('actual_sell_volumen')->nullable()->after('description');
            $table->longText('sell_volumen_last_month')->nullable()->after('actual_sell_volumen');
            $table->string('logistic')->nullable()->after('sell_volumen_last_month');
            $table->string('time_ship')->nullable()->after('logistic');
            $table->string('pay_method')->nullable()->after('time_ship');
            $table->string('comision')->nullable()->after('pay_method');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
