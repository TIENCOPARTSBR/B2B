<?php

namespace App\Http\Controllers\DirectDistributor\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use Illuminate\Http\Request;
use App\Exports\ProductSisrevExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductSisrevController extends Controller
{
    // index
    public function index()
    {
        return view('direct-distributor.product.search.index');
    }

    // search
    public function show(ProductSisrev $product, Request $request)
    {   
        // transform in array
        $part_number = explode(',', trim($request->part_number));

        // get products
        $product = $product->with('product_photo')->whereIn('part_number', array_unique($part_number))->get();

        // remove languages
        if(app()->getLocale() == 'pt') unset($product['descricao_en'], $product['descricao_es']);
        if(app()->getLocale() == 'en') unset($product['descricao_br'], $product['descricao_es']);
        if(app()->getLocale() == 'es') unset($product['descricao_en'], $product['descricao_br']);

        return view('direct-distributor.product.search.show', ['product' => $product]);
    }

    // return view product reports
    public function report()
    {
        return view('direct-distributor.product.report.index');
    }

    // export all products sisrev
    public function export() 
    {
        return Excel::download(new ProductSisrevExport, 'products.xlsx');
    }
}
