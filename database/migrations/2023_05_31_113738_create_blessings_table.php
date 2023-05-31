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
        Schema::create('blessings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('blessing_type');
            $table->date('date');
            $table->time('time');
            $table->string('religion');
            $table->string('address')->nullable()->default('N/A');
            $table->string('landmark')->nullable()->default('N/A');
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
        Schema::dropIfExists('blessings');
    }
};
