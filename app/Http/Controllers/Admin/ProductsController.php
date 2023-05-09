<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsSisrev;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // index
    public function index()
    {
        return view('admin.products.index');
    }

    // search
    public function search(Request $request)
    {   
        $products = ProductsSisrev::search($request->partNumber);
        return view('admin.products.show', ['products' => $products]);
    }
}
