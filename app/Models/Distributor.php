<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $table = 'distributor';

    protected $fillable = [
        'name',
        'is_active',
        'allow_product_report',
        'allow_quotation',
        'cif_freight',
        'profit_margin_option',
        'profit_margin_value'
    ];

    public function ProductValueDistributor()
    {
        return $this->hasMany(ProductValueDistributor::class, 'id_distributor', 'id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}
