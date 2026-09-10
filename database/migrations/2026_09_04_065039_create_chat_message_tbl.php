<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Same data structure for chat messages and chat event messages
     */
    public function up(): void
    {
        Schema::create('chat_message_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('message');
            $table->string('sender')->nullable();
            $table->string('message_type')->nullable();
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_message_tbl');
    }
};
