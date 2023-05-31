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
        Schema::create('funerals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('name');
            $table->integer('age');
            $table->string('status');
            $table->string('religion');
            $table->string('address');
            $table->date('date_of_death');
            $table->string('cause_of_death');
            $table->string('cemetery');
            $table->string('funeraria');
            $table->string('contact_person');
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
        Schema::dropIfExists('funerals');
    }
};
