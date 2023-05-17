<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserDirectDistributor extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_direct_distributor';

    protected $fillable = [
        'type',
        'name',
        'mail',
        'password',
        'is_active',
        'direct_distributor_id',
    ];

    public function direct_distributor()
    {
        return $this->belongsTo(DirectDistributor::class);
    }
}
