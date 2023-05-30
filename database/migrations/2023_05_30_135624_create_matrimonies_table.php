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
        Schema::create('matrimonies', function (Blueprint $table) {
            $table->id();
            $table->string('grooms_name');
            $table->date('grooms_birth_date');
            $table->string('brides_name');
            $table->date('brides_birth_date');
            $table->date('wedding_date');
            $table->string('contact_number');
            $table->unsignedMediumInteger('created_by_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrimonies');
    }
};
