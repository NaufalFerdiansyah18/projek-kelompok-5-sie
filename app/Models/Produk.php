<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Umkm extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';
    protected $fillable = [
        'name',
        'price',
        'description',
    ];
}
class Produk extends Model
{
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

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'produk_id', 'produk_id');
    }

}
