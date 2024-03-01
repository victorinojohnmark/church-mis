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
        Schema::table('baptisms', function (Blueprint $table) {
            $table->string('sponsor_1')->after('mothers_name');
            $table->string('sponsor_2')->after('sponsor_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baptisms', function (Blueprint $table) {
            $table->dropColumn('sponsor_1');
            $table->dropColumn('sponsor_2');
        });
    }
};
