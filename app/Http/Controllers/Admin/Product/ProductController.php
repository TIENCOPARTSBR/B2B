<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.search.index');
    }

    public function show(ProductSisrev $product, Request $request)
    {   
        $part_number = explode(',', trim($request->part_number));

        $product = $product->with('product_photo')->whereIn('part_number', array_unique($part_number))->get();

        if(app()->getLocale() == 'pt') unset($product['descricao_en'], $product['descricao_es']);
        if(app()->getLocale() == 'en') unset($product['descricao_br'], $product['descricao_es']);
        if(app()->getLocale() == 'es') unset($product['descricao_en'], $product['descricao_br']);

        return view('admin.product.search.show', ['product' => $product]);
    }
}
