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
            $table->dropColumn('guardian');
            $table->string('father')->after('birth_date');
            $table->string('mother')->after('father');
            $table->string('sponsor_1')->after('mother');
            $table->string('sponsor_2')->after('sponsor_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communion_details', function (Blueprint $table) {
            //
        });
    }
};
