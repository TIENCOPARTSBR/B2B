<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Imports\ProductValueDistributorImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DistributorImportController extends Controller
{
    public function index(Request $request)
    {
        return Excel::toArray(new ProductValueDistributorImport, $request->file('excel'));
    }
}