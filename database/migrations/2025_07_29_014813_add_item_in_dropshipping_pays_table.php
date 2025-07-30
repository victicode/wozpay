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
        Schema::table('dropshipping_pays', function (Blueprint $table) {
            //
            $table->longText('shipping_data')->nullable()->after("dropshipping_link_id");
            $table->longText('pay_data')->nullable()->after("shipping_data");
            $table->string('client_name')->nullable()->after("pay_data");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dropshipping_pays', function (Blueprint $table) {
            //
        });
    }
};
