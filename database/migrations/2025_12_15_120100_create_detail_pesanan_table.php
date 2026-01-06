<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->bigIncrements('detail_id');
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('qty');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            $table->foreign('pesanan_id')
                  ->references('pesanan_id')
                  ->on('pesanan')
                  ->onDelete('cascade');

            $table->foreign('produk_id')
                  ->references('produk_id')
                  ->on('produk')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
