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
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade'); //sprzedawca
            $table->string('name'); //nazwa ubrania
            $table->string('description'); //opis ubrania
            $table->foreignId('size_id')->nullable()->constrained('sizes')->nullonDelete(); //rozmiar
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete(); //kategoria
            $table->decimal('price',10,2)->unsigned(); //cena
            $table->string('condition'); //stan
            $table->text('image_path')->nullable(); //sciezka do zdjecia
            $table->enum('status',['dostępny','sprzedany'])->default('dostępny'); //status produktu
            $table->foreignId('order_id')->nullable()->constrained('orders')->nullOnDelete();
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
