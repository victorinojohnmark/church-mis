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
        Schema::create('document_request_deaths', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('user_id');
            $table->string('name');
            $table->integer('age');
            $table->string('status');
            $table->string('religion');
            $table->date('date_of_death');
            $table->string('cause_of_death');
            $table->string('address');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->date('requested_date');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_ready')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_request_deaths');
    }
};
