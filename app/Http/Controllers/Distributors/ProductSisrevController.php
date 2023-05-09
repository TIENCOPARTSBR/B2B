<?php

namespace App\Http\Controllers\Distributors;

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
        return view('distributor.product.index');
    }

    // search
    public function show(Request $r)
    {   
        return view('distributor.product.show', ['product' => ProductSisrev::show($r->partNumber)]);
    }

    // export all products sisrev
    public function export() 
    {
        return Excel::download(new ProductSisrevExport, 'products.xlsx');
    }
}
