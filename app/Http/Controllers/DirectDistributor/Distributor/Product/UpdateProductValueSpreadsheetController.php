<?php

namespace App\Http\Controllers\DirectDistributor\Distributor\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UpdateProductValueSpreadsheetController extends Controller
{
    public function index($id)
    {
        return view('direct-distributor.distributor.value.import.index')
            ->with('id', $id);
    }

    public function import(Request $request)
    {
        // importing
        $excel_imported = Excel::toArray(new ProductValue, $request->file('excel'));

        // deleted header excel
        unset($excel_imported[0][0]);

        $html = [];
        $key = 0;

        foreach($excel_imported[0] as $excel)
        {
            $html[] = "
                <div class='tbody' data-form='$key'>
                    <input type='hidden' name='_method' value='POST'>
                    <input type='hidden' name='distributor_id' value='$request->distributor_id'>
                    
                    <div class='td'>
                        <input type='text' name='part_number[$key]' value='$excel[0]' class='form-input'>
                    </div>
                    
                    <div class='td'>
                        <input type='text' name='percentage[$key]' value='$excel[1]' class='form-input'>
                    </div>
                    
                    <div class='td'>
                        <input type='text' name='unit_price[$key]' value='$excel[2]' class='form-input'>
                    </div>
                    
                    <div class='td'>
                        <div class='table-button'>
                            <button type='button' data-trigger='delete' onclick='removeRowForm($key)'></button>
                        </div>
                    </div>
                </div>
            ";

            $key + $key++;
        }

        return response()->json(json_encode($html),200);
    }

    public function store(ProductValue $productValue, Request $request)
    {
        foreach($request->part_number as $key => $part_number) { $product[$key]['PART_NUMBER'] = $part_number; }
        foreach($request->percentage as $key => $percentage) { $product[$key]['PERCENTAGE'] = $percentage; }
        foreach($request->unit_price as $key => $unit_price) { $product[$key]['UNIT_PRICE'] = $unit_price; }

        foreach($product as $product){
            
            if(!empty($product['PERCENTAGE'])){
                $type = 'PERCENTAGE'; 
                $value = $product['PERCENTAGE'];
            }

            if(!empty($product['UNIT_PRICE'])) {
                $type = 'UNIT_PRICE'; 
                $value = $product['UNIT_PRICE'];
            }

            $prod = [
                'part_number' => $product['PART_NUMBER'],
                'product_value' => $value,
                'value_type' => $type,
                'direct_distributor_id' => Auth::guard('distributor')->user()->direct_distributor_id,
                'distributor_id' => $request->distributor_id
            ];

            $productValue::create($prod);
        }

        return back()
            ->with('successfully', __('messages.New product value'));
    }
}
