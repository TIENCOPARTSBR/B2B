<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSisrev extends Model
{
    use HasFactory;

    protected $table = 'product_sisrev';

    public static function show( $partNumber )
    {
        $partNumbers = explode(',', str_replace(' ', '', $partNumber));

        $descricao = 'descricao_br';
        if(app()->getLocale() == 'EN'){
            $descricao = 'descricao_en';
        }
        if(app()->getLocale() == 'ES'){
            $descricao = 'descricao_es';
        }
        
        return ProductSisrev::select('part_number', 'saldo_br', 'saldo_eua', 'peso', 'ncm', 'hscode', ''.$descricao.' as descricao')->whereIn('part_number' ,array_unique($partNumbers))->get();
    }
}
