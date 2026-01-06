<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSearch;

class Pelanggan extends Model
{
    use HasSearch;

    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone',
        'files',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    protected array $searchableColumns = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];
    
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'pelanggan_id';
    }
}
