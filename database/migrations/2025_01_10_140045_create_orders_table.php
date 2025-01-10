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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade'); //kupujący
            $table->foreignId('delivery_method_id')->constrained('delivery_methods')->onDelete('cascade'); //sposob dostawy
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade'); //sposob dostawy
            $table->enum('payment_status',['oczekująca','zakończona'])->default('oczekująca'); //status platnosci
//            $table->foreignId('offer_id')->nullable()->constrained('offers')->nullonDelete(); //produkt
            $table->decimal('total_price',10,2); //laczna cena zamowienia: produkty+sposob dostawy
            $table->enum('order_status',['oczekujące','przetwarzane','zrealizowane'])->default('oczekujące'); //status zamowienia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
