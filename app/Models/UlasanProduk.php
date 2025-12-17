<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSearch;

class UlasanProduk extends Model
{
    use HasSearch;

    protected $table = 'ulasan_produk';
    protected $primaryKey = 'ulasan_id';

    protected $fillable = [
        'produk_id',
        'warga_id',
        'rating',
        'komentar',
    ];

    protected array $searchableColumns = [
        'komentar',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}
