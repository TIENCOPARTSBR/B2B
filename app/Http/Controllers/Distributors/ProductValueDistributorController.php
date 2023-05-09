<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\ProductValueDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductValueDistributorController extends Controller
{
    // show
    public function show(Request $r)
    {
        $r->validate([ 'part_number' => 'required||min:3' ],
        [ 'part_number' => __('messages.Part number is required') ]);

        return view('distributor.distributors.view', ['type' => ProductValueDistributor::show($r->only('id_distributor', 'part_number')), 
                                                'general' => Distributor::getGeneralValue($r->only('id_distributor'))]);
    }

    // store
    public function store(Request $r)
    {
        $r->validate([ 'part_number' => 'required||max:10', 'product_value' => 'required', 'value_type' => 'required'], 
                    [ 'part_number' => __('messages.Part number is required'), 'product_value' => __('messages.Value is required') ]);

        ProductValueDistributor::store(
            $r->only('id_distributor', 'part_number', 'product_value', 'value_type')
        );

        return Redirect::back()->with('successfully', __('messages.New product value'));
    }

    // updated
    public function updated(Request $r)
    {
        $r->validate([ 'part_number' => 'required||max:10', 'product_value' => 'required', 'value_type' => 'required'], 
                     [ 'part_number' => __('messages.Part number is required'), 'product_value' => __('messages.Value is required') ]);

        ProductValueDistributor::updated(
            $r->only('id', 'id_distributor', 'part_number', 'product_value', 'value_type')
        );

        return Redirect::back()->with('successfully', __('messages.Updated product value'), 'selected', 'product');
    }

    // destroy
    public static function destroy($id)
    {
        ProductValueDistributor::destroy($id);

        return Redirect::back()->with('successfully', __('messages.Deleted product value'));
    }
}
