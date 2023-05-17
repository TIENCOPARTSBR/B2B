<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserDistributor extends Model
{
    use HasFactory;

    protected $table = 'user_distributor';

    protected $fillable = [
        'name',
        'mail',
        'password',
        'is_active',
        'id_distributor'
    ];

    public function Distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
