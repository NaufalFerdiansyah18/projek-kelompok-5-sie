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
        Schema::create('umkm', function (Blueprint $table) {
            $table->increments('umkm_id');
            $table->string('nama_usaha', 200);
            $table->unsignedInteger('pemilik_warga_id');
=======
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->bigIncrements('umkm_id'); // pakai big integer
            $table->string('nama_usaha', 200);
            $table->unsignedBigInteger('pemilik_warga_id');
>>>>>>> fe8a477c8b7ad5e754c726be93f44b3b629edc33
            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('kategori', 100);
            $table->string('kontak', 50);
            $table->text('deskripsi')->nullable();
<<<<<<< HEAD
            $table->string('logo_foto_usaha')->nullable(); // untuk menyimpan path file
            $table->timestamps();

            // Foreign key constraint (jika ada tabel warga)
            // $table->foreign('pemilik_warga_id')->references('warga_id')->on('warga');
        });
    }

    /**
     * Reverse the migrations.
     */
=======
            $table->string('logo_foto_usaha')->nullable();
            $table->timestamps();

            // Jika nanti tabel warga sudah ada
            // $table->foreign('pemilik_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
        });
    }

>>>>>>> fe8a477c8b7ad5e754c726be93f44b3b629edc33
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
