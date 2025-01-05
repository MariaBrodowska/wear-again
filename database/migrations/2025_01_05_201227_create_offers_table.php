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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); //sprzedawca
            $table->string('name'); //nazwa ubrania
            $table->string('description'); //opis ubrania
            $table->foreignId('size_id')->nullable()->constrained('sizes'); //rozmiar
            $table->foreignId('category_id')->constrained('categories'); //kategoria
            $table->decimal('price',10,2); //cena
            $table->string('condition'); //stan
            $table->text('image_path')->nullable(); //sciezka do zdjecia
            $table->enum('status',['dostępny','sprzedany'])->default('dostępny'); //status produktu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
