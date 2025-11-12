<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->bigIncrements('umkm_id'); // pakai big integer
            $table->string('nama_usaha', 200);
            $table->unsignedBigInteger('pemilik_warga_id');
            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('kategori', 100);
            $table->string('kontak', 50);
            $table->text('deskripsi')->nullable();
            $table->string('logo_foto_usaha')->nullable();
            $table->timestamps();

            // Jika nanti tabel warga sudah ada
            // $table->foreign('pemilik_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
