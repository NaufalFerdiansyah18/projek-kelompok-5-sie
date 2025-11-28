<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah kolom gender dari enum menjadi string
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->string('gender', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->change();
        });
    }
};
