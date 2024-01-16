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
        Schema::table('communions', function (Blueprint $table) {
            $table->date('date')->nullable()->change();
            $table->date('birth_date')->nullable()->change();
            $table->string('fathers_name')->nullable()->change();
            $table->string('mothers_name')->nullable()->change();
            $table->string('file')->after('contact_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communions', function (Blueprint $table) {
            //
        });
    }
};
