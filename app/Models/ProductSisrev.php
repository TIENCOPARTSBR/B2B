<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSisrev extends Model
{
    use HasFactory;

    protected $table = 'product_sisrev';

    public function product_photo()
    {
        return $this->hasMany(ProductPhoto::class, 'part_number', 'part_number');
    }
}