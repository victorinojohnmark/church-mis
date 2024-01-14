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
        Schema::table('document_request_baptisms', function (Blueprint $table) {
            $table->string('birth_place', 255)->after('birth_date');
            $table->string('sex', 15)->after('birth_place');
            $table->string('relationship', 50)->after('sex');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_request_baptisms', function (Blueprint $table) {
            //
        });
    }
};
