<?php

namespace App\Http\Controllers\DirectDistributor\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUnitaryValueController extends Controller
{
    public function index(ProductValue $productValue)
    {
        return view('direct-distributor.product.value.unitary.index')
            ->with('type', $productValue::where('direct_distributor_id', Auth::guard('direct-distributor')->user()->direct_distributor_id)->paginate(10));
    }

    public function show(ProductValue $productValue, Request $request)
    {
        return view('direct-distributor.product.value.unitary.index')
            ->with('type', $productValue::where('part_number',$request['part_number'])->paginate(10));
    }

    public function store(ProductValue $productValue, Request $request)
    {
        $request->validate([ 
            'part_number' => 'required|min:3', 
            'product_value' => 'required', 
            'value_type' => 'required'
        ]);

        $productValue::create($request->all());

        return to_route('direct.distributor.product.value.unitary.index')
            ->with('successfully', __('messages.New product value'));
    }

    public function updated(ProductValue $productValue, Request $request)
    {
        $request->validate([ 
            'part_number' => 'required|min:3', 
            'product_value' => 'required', 
            'value_type' => 'required'
        ]);

        $productValue::findOrFail($request->id)->update($request->all());

        return to_route('direct.distributor.product.value.unitary.index')
            ->with('successfully', __('messages.New product value'));
    }

    public function destroy(ProductValue $productValue, Request $request)
    {
        $productValue::findOrFail($request->id_delete)->delete();

        return to_route('direct.distributor.product.value.unitary.index')
            ->with('successfully', __('messages.New product value'));
    }
}
