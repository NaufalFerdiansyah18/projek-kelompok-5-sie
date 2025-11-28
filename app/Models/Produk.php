<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSearch;

class Produk extends Model
{
    use HasSearch;
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'status',
    ];

    protected array $searchableColumns = [
        'nama_produk',
        'deskripsi',
        'status',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'produk_id', 'produk_id');
    }
}
