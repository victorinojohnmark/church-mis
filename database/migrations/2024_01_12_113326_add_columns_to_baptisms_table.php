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
            $table->time('time')->after('date');
            $table->string('sex', 15)->after('time');
            $table->string('relationship', 50)->after('sex');
            $table->string('place_of_birth', 255)->after('birth_date');
            $table->boolean('is_special')->default(false)->after('time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baptisms', function (Blueprint $table) {
            //
        });
    }
};
