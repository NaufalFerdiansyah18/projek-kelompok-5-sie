<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom 'id' manual pada tabel warga.
     */
    public function up(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->string('id', 20)->unique()->nullable()->after('warga_id');
        });
    }

    /**
     * Hapus kolom 'id' jika di-rollback.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
