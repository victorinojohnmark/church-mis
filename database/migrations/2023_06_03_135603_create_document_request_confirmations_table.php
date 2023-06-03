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
        Schema::create('document_request_confirmations', function (Blueprint $table) {
            $table->id();
            $table->string('request_code')->nullable();
            $table->unsignedMediumInteger('user_id');
            $table->string('name');
            $table->date('confirmation_date');
            $table->string('contact_number');
            $table->date('birth_date');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('address');
            $table->string('purpose');
            $table->date('requested_date');
            $table->boolean('is_ready')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_request_confirmations');
    }
};
