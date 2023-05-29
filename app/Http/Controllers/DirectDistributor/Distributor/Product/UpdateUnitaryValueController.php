<?php

namespace App\Http\Controllers\DirectDistributor\Distributor\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUnitaryValueController extends Controller
{
    public function index(ProductValue $productValue, $id)
    {
        $value = $productValue::where('direct_distributor_id', Auth::guard('distributor')->user()->direct_distributor_id)
            ->where('distributor_id', $id)
            ->paginate(10);

        return view('direct-distributor.distributor.value.unitary.index')
            ->with('id', $id)
            ->with('type', $value);
    }

    public function show(ProductValue $productValue, Request $request, $id)
    {
        $value = $productValue::where('direct_distributor_id', Auth::guard('distributor')->user()->direct_distributor_id)
        ->where('distributor_id', $id)
        ->where('part_number', 'LIKE', '%'.$request->part_number.'%')
        ->paginate(10);

        return view('direct-distributor.distributor.value.unitary.index')
            ->with('id', $id)
            ->with('type', $value);
        }

    public function store(ProductValue $productValue, Request $request)
    {
        $request->validate([ 
            'part_number' => 'required|min:3', 
            'product_value' => 'required', 
            'value_type' => 'required'
        ]);

        $productValue::create($request->all());

        return back()
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

        return back()
            ->with('successfully', __('messages.Valor do produto atualizado'));
    }

    public function destroy(ProductValue $productValue, Request $request)
    {
        $productValue::findOrFail($request->id_delete)->delete();

        return back()
            ->with('successfully', __('messages.Deleted product value'));
    }
}
