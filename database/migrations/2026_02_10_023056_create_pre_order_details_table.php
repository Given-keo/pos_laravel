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
        Schema::create('pre_order_details', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke header PreOrder
            $table->foreignId('pre_order_id')
                  ->constrained('pre_orders')
                  ->onDelete('cascade');

            // Relasi ke produk
            $table->foreignId('produk_id')
                  ->constrained('products')
                  ->onDelete('restrict');

            $table->integer('qty')->default(1);
            $table->decimal('harga', 15, 2);
            $table->decimal('subtotal', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_order_details');
    }
};
