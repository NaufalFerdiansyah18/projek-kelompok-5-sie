<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('pesanan_id');
            $table->string('nomor_pesanan', 50)->unique();
            $table->unsignedBigInteger('warga_id');
            $table->decimal('total', 15, 2)->default(0);
            $table->string('status', 50)->default('baru');
            $table->text('alamat_kirim')->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('metode_bayar', 50)->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();

            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
