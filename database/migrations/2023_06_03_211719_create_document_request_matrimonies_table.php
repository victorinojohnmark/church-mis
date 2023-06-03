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
        Schema::create('document_request_matrimonies', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('user_id');
            $table->string('grooms_name');
            $table->date('grooms_birth_date');
            $table->string('brides_name');
            $table->date('brides_birth_date');
            $table->date('matrimony_date');
            $table->string('contact_number');
            $table->string('address');
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
        Schema::dropIfExists('document_request_matrimonies');
    }
};
