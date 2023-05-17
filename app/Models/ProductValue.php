<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;

    protected $table = 'product_value';

    protected $fillable = [
        'part_number',
        'product_value',
        'value_type',
        'direct_distributor_id',
        'distributor_id'
    ];

    public function Distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function DirectDistributor()
    {
        return $this->belongsTo(DirectDistributor::class);
    }

    public function QuotationItem()
    {
        return $this->belongsTo(QuotationItem::class);
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('part_number', 'ASC');
        });
    }

    /* public function exist($part_number)
    {
        $part_number = ProductValue::select('part_number')->where('part_number', $part_number)->limit(1);
        dd($part_number->part_number);
        if(!empty($part_number[0])) return true;
        return false;
    } */
}
