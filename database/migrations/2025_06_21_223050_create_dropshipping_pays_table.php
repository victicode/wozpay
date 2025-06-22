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
        Schema::create('dropshipping_pays', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->unsignedBigInteger('coin_id');
            $table->foreign('coin_id')->references('id')->on('coins')->onDelete('cascade');
            $table->integer('rate_amount');
            $table->integer('status');
            $table->unsignedBigInteger('dropshipping_link_id');
            $table->foreign('dropshipping_link_id')->references('id')->on('dropshipping_links')->onDelete('cascade');
            $table->integer('method');
            $table->string('operation_id')->nullable();
            $table->string('bank')->nullable();
            $table->date('pay_date')->nullable();
            $table->longText('vaucher')->nullable();
            $table->string('card')->nullable();
            $table->string('card_name')->nullable();
            $table->string('card_cvc')->nullable();
            $table->string('card_due_date')->nullable();
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropshipping_pays');
    }
};
