<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $table = "quotation_item";

    protected $fillable = [
        "quotation_id",
        "product_sisrev_id",
        "country",
        "quantity",
        "status",
        "product_exists"
    ];

    public function Quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function ProductSisrev()
    {
        return $this->hasMany(ProductSisrev::class, 'part_number', 'product_sisrev_id');
    }
}
