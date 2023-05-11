<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValueDistributor extends Model
{
    use HasFactory;

    protected $table = 'product_value_distributor';

    protected $fillable = [
        'id',
        'part_number',
        'product_value',
        'value_type',
        'is_active',
        'id_distributor'
    ];

    public function Distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
