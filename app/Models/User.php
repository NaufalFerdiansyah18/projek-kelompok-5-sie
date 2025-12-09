<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Concerns\HasSearch;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasSearch;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'email',
        'password',
        'profile_picture',
        'role',
    ];

    protected array $searchableColumns = [
        'first_name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
