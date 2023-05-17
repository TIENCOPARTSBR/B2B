<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = "quotation";

    protected $dates = ['reply_date' => 'm-d-Y'];

    protected $fillable = [
        "direct_distributor_id",
        "distributor_id",
        "status",
        "customer_name",
        "requester_quotation",
        "quotation_type",
        "general_observation",
        "urgent",
        "reply_date"
    ];

    public function QuotationItem()
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id', 'id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('id', 'DESC');
        });
    }
}
