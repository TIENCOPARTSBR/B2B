<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class directDistributorPasswordResets extends Model
{
    use HasFactory;

    protected $table = "direct_distributor_password_resets";

    protected $fillabe = [
        'mail',
        'token',
    ];
}
