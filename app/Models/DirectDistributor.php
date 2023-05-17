<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectDistributor extends Model
{
    use HasFactory;

    protected $table = 'direct_distributor';

    protected $fillable = [
        'name',
        'is_active',   
        'cif_freight',
        'general_value',
        'option_general_value',
        'allow_quotation',
        'allow_partner',
        'allow_product_report'
    ];

    public function user_direct_distributor()
    {
        return $this->hasMany(UserDirectDistributor::class, 'direct_distributor_id', 'id');
    }
}
