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
        'profit_margin_value',
        'direct_distributor_id'
    ];

    public function ProductValue()
    {
        return $this->hasMany(ProductValue::class, 'distributor_id', 'id');
    }

    public function UserDistributor()
    {
        return $this->hasMany(UserDistributor::class, 'distributor_id', 'id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}
