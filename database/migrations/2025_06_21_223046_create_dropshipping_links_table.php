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
        Schema::create('dropshipping_links', function (Blueprint $table) {
            $table->id();
            $table->longText('url');
            $table->string('code');
            $table->double('amount');
            $table->double('amount_to_client');
            $table->unsignedBigInteger('coin_id');
            $table->foreign('coin_id')->references('id')->on('coins')->onDelete('cascade');
            $table->integer('rate_amount');
            $table->integer('status');
            $table->integer('pay_status');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('products');
            $table->dateTime('due_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropshipping_links');
    }
};
