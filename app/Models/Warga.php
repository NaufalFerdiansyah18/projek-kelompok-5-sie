<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSearch;

class Warga extends Model
{
    use HasFactory, HasSearch;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    public $timestamps = false;

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    protected array $searchableColumns = [
        'no_ktp',
        'nama',
        'pekerjaan',
        'telp',
        'email',
    ];
}
