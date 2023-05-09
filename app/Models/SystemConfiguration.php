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
    
    // store
    public static function store($r)
    {
        $config = [
            'name' => 'Receipt quotation e-mail',
            'key_name' => 'receipt_quotation_email',
            'key_value' => $r['receipt_quotation_email']
        ];

        SystemConfiguration::create($config);
    }

    // updated
    public static function updated($r)
    {
        $config = SystemConfiguration::findOrFail('1');
        $config->key_value = $r;
        $config->update();
    }

    // quotation receipt email 
    public static function getSystemKeyName($r)
    {
        return SystemConfiguration::select('key_value as value')->where('key_name', $r)->get();
    }
}
