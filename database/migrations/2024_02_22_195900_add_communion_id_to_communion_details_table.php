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
        Schema::table('communion_details', function (Blueprint $table) {
            $table->unsignedMediumInteger('communion_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communion_details', function (Blueprint $table) {
            $table->dropColumn('communion_id');
        });
    }
};
