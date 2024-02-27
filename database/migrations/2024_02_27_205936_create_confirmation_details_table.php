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
        Schema::create('confirmation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('confirmation_id');
            $table->string('name');
            $table->date('birth_date');
            $table->string('father');
            $table->string('mother');
            $table->string('sponsor_1');
            $table->string('sponsor_2');
            $table->string('contact_number');
            $table->string('present_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmation_details');
    }
};
