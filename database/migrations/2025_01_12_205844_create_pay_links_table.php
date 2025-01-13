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
        Schema::create('pay_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id')->nullable();
            $table->double('amount');
            $table->string('type');
            $table->string('status');
            $table->string('concept');
            $table->string('operation_id')->nullable();
            $table->string('bank')->nullable();
            $table->date('pay_date')->nullable();
            $table->longText('vaucher')->nullable();
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_links');
    }
};
