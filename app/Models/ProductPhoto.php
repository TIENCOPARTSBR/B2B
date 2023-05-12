<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $table = "product_photo";

    public function product_photo()
    {
        return $this->belongsTo(ProductSisrev::class);
    }
}
