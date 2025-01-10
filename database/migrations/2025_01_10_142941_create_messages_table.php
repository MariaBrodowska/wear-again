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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); //osoba ktora wysyla
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); //osoba ktora otrzymuje
            $table->string('content');
            $table->enum('is_read',['przeczytana','nieprzeczytana'])->default('nieprzeczytana'); //status wiadomosci
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
