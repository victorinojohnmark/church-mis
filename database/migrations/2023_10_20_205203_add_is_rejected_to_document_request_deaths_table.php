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
        Schema::table('document_request_deaths', function (Blueprint $table) {
            $table->boolean('is_rejected')->nullable()->default(false)->after('is_active');
            $table->string('rejection_message', 255)->nullable()->after('is_rejected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_request_deaths', function (Blueprint $table) {
            $table->dropColumn('is_rejected');
            $table->dropColumn('rejection_message');
        });
    }
};
