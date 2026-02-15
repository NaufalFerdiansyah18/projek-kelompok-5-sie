<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
<<<<<<< HEAD
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->integer('price');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }

=======
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('produk_id');
            $table->unsignedBigInteger('umkm_id'); // tipe harus cocok dengan umkm_id
            $table->string('nama_produk', 200);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 15, 2);
            $table->integer('stok');
            $table->string('foto_produk')->nullable();
            $table->timestamps();

            // Foreign key ke tabel umkm
            $table->foreign('umkm_id')
                  ->references('umkm_id')
                  ->on('umkm')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
>>>>>>> fe8a477c8b7ad5e754c726be93f44b3b629edc33
};
