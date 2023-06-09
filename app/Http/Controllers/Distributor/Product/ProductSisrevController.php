<?php

namespace App\Http\Controllers\Distributor\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use Illuminate\Http\Request;
use App\Exports\ProductSisrevExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductSisrevController extends Controller
{
    public function index()
    {
        return view('distributor.product.search.index');
    }

    public function show(ProductSisrev $product, Request $request)
    {   
        // transform in array
        $part_number = explode(',', $request->part_number);

        $part_number = array_map('trim', $part_number);

        // set languages
        if(app()->getLocale() == 'pt') $description = 'descricao_br';
        if(app()->getLocale() == 'en') $description = 'descricao_en';
        if(app()->getLocale() == 'es') $description = 'descricao_es';

        // get products
        $product = $product->with('product_photo')
            ->select('*', $description.' as description')
            ->whereIn('part_number', array_unique($part_number))
            ->get();

        if(empty($product[0])) $product = false;

        return view('distributor.product.search.show')
            ->with('product', $product);
    }

    public function report()
    {
        return view('distributor.product.report.index');
    }

    public function export()
    {
        return Excel::store(new ProductSisrevExport, 'product.xlsx', 's3');
    }
}
