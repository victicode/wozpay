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
        Schema::table('pay_links', function (Blueprint $table) {
            $table->unsignedBigInteger('coin_id')->after('amount')->nullable();
            $table->foreign('coin_id')->references('id')->on('coins')->onDelete('cascade');
        });
        Schema::table('links', function (Blueprint $table) {
            $table->unsignedBigInteger('coin_id')->after('amount')->nullable();
            $table->foreign('coin_id')->references('id')->on('coins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pay_links', function (Blueprint $table) {
            //
        });
    }
};
