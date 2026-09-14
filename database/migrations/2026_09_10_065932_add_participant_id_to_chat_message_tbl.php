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
        Schema::table('chat_message_tbl', function (Blueprint $table) {

            $table->unsignedBigInteger('participantId')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_message_tbl', function (Blueprint $table) {

            $table->dropColumn('participantId');
        });
    }
};
