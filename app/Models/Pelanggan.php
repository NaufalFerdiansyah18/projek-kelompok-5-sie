<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
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
    ];
    
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'pelanggan_id';
    }
}
