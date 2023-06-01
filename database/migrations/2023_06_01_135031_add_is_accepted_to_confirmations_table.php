<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('confirmations', function (Blueprint $table) {
            $table->boolean('is_accepted')->default(false)->after('created_by_id');
            $table->text('accepted_message')->nullable()->after('is_accepted');

            $table->boolean('is_rejected')->default(false)->after('accepted_message');
            $table->text('rejection_message')->nullable()->after('is_rejected');
        });
    }

    public function down(): void
    {
        Schema::table('confirmations', function (Blueprint $table) {
            $table->dropColumn('is_accepted');
            $table->dropColumn('accepted_message');
            $table->dropColumn('is_accepted');
            $table->dropColumn('rejection_message');
        });
    }
};
