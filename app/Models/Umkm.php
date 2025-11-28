<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSearch;

class Umkm extends Model
{
    use HasSearch;

    protected $table = 'umkm';
    protected $primaryKey = 'umkm_id';
    protected $fillable = [
        'nama_usaha',
        'pemilik_warga_id',
        'alamat',
        'rt',
        'rw',
        'kategori',
        'kontak',
        'deskripsi',
        'logo_foto_usaha',
    ];

    protected array $searchableColumns = [
        'nama_usaha',
        'alamat',
        'kategori',
        'kontak',
        'deskripsi',
    ];
}
