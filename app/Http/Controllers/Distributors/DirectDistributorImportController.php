<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Imports\ProductValueDirectDistributorImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DirectDistributorImportController extends Controller
{
    public function index(Request $request)
    {
        // importing
        $excel_imported = Excel::toArray(new ProductValueDirectDistributorImport, $request->file('excel'));

        // deleted header excel
        unset($excel_imported[0][0]);

        $html = [];
        $key = 0;

        foreach($excel_imported[0] as $excel)
        {
            $html[] = "
                <form action=".route('produto.valor.import.store')." class='tbody submitFormProduct' data-form='$key'>
                    <input type='hidden' name='_method' value='POST'>
                    
                    <div class='td'>
                        <input type='text' name='part_number' value='$excel[0]' class='form-input'>
                    </div>
                    
                    <div class='td'>
                        <input type='text' name='product_value' value='$excel[1]' class='form-input'>
                    </div>
                    
                    <div class='td'>
                        <input type='text' name='product_value' value='$excel[2]' class='form-input'>
                    </div>
                    
                    <div class='td'>
                        <div class='table-button'>
                            <button type='button' data-trigger='delete' onclick='removeRowForm($key)'></button>
                        </div>
                    </div>
                </form>
            ";

            $key + $key++;
        }

        return response()->json(json_encode($html),200);
    }

    public function store(Request $request)
    {
        return response()->json('foi',200);
    }
}