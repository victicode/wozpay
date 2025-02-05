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
            $table->integer('method')->after('amount');
            $table->string('card')->after('vaucher')->nullable();
            $table->string('card_name')->after('card')->nullable();
            $table->integer('cvc')->after('card_name')->nullable();
            $table->string('due_date')->after('cvc')->nullable();
            $table->string('email')->after('due_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
