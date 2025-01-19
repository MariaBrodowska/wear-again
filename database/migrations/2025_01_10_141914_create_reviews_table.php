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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade'); //osoba ktora oceniono, jesli usuwamy to znikaja opinie
            $table->foreignId('buyer_id')->nullable()->constrained('users')->nullonDelete(); //osoba ktora oceniono, jesli usuwamy to jej opinia zostaje
            $table->decimal('rating', 3)->unsigned();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
