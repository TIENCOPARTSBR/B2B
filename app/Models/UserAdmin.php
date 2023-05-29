<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_admin';

    protected $fillable = [
        'name',
        'mail',
        'password',
        'is_active'
    ];
}
