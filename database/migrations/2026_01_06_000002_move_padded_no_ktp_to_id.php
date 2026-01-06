<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $rows = DB::table('warga')
            ->select('warga_id', 'no_ktp')
            ->whereRaw('no_ktp REGEXP "^0{6,}[0-9]+$"')
            ->get();

        foreach ($rows as $row) {
            DB::table('warga')
                ->where('warga_id', $row->warga_id)
                ->update([
                    'id' => $row->no_ktp,
                    'no_ktp' => null,
                ]);
        }
    }

    public function down(): void
    {
        $rows = DB::table('warga')
            ->select('warga_id', 'id', 'no_ktp')
            ->whereRaw('id REGEXP "^0{6,}[0-9]+$"')
            ->whereNull('no_ktp')
            ->get();

        foreach ($rows as $row) {
            DB::table('warga')
                ->where('warga_id', $row->warga_id)
                ->update([
                    'no_ktp' => $row->id,
                    'id' => null,
                ]);
        }
    }
};
