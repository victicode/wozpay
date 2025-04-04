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
        Schema::table('links', function (Blueprint $table) {
            //
            $table->integer('recurring_day')->nullable()->after('due_time');
            $table->date('init_day')->nullable()->after('recurring_day');
            $table->enum('is_recurring',['yes', 'no'])->nullable()->after('init_day');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            //
        });
    }
};
