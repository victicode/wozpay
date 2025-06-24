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
        Schema::create('pay_adds', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string('type');
            $table->string('status');
            $table->string('concept');
            $table->integer('method');
            $table->string('operation_id')->nullable();
            $table->string('bank')->nullable();
            $table->date('pay_date')->nullable();
            $table->longText('vaucher')->nullable();
            $table->string('card')->nullable();
            $table->string('card_name')->nullable();
            $table->integer('card_cvc')->nullable();
            $table->string('card_due_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_adds');
    }
};
