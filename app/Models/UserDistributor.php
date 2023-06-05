<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserDistributor extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_distributor';

    protected $fillable = [
        'name',
        'mail',
        'password',
        'is_active',
        'distributor_id'
    ];

    public function Distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
