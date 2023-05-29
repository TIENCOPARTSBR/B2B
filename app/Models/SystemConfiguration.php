<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemConfiguration extends Model
{
    use HasFactory;

    protected $table = 'system_configuration';

    protected $fillable = [
        'name',
        'key_name',
        'key_value'
    ];

    // quotation receipt email 
    public static function getSystemKeyName($r)
    {
        return SystemConfiguration::select('key_value as value')->where('key_name', $r)->get();
    }
}
