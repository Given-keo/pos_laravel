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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_preorder')->unique(); // kode transaksi / pre-order
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans')->onDelete('set null'); // pelanggan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // kasir / admin
            $table->foreignId('metode_pembayaran_id')->constrained('metode_pembayarans')->onDelete('cascade');
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('bayar', 15, 2)->default(0); // bisa DP
            $table->decimal('kembalian', 15, 2)->default(0);
            $table->date('tanggal_kirim')->nullable(); // estimasi tanggal kirim
            $table->enum('status', ['DP', 'Lunas', 'Pending'])->default('Pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('pre_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_order_id')->constrained('pre_orders')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('products')->onDelete('cascade');
            $table->decimal('harga', 15, 2);
            $table->integer('qty');
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
        Schema::dropIfExists('pre_orders');
    }
};
