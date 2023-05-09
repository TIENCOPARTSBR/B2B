<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Models\DirectDistributor;
use App\Models\ProductValueDirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductValueDirectDistributorController extends Controller
{
    // index
    public function index()
    {
        return view('distributor.value.index', ['type' => ProductValueDirectDistributor::index(), 
                                                'general' => DirectDistributor::getGeneralValue()]);
    }

    // show
    public function show(Request $r)
    {
        $r->validate([ 'part_number' => 'required||min:3' ],
        [ 'part_number' => __('messages.Part number is required') ]);

        return view('distributor.value.index', ['type' => ProductValueDirectDistributor::show($r->only('part_number')), 
                                                'general' => DirectDistributor::getGeneralValue()]);
    }

    // store
    public function store(Request $r)
    {
        $r->validate([ 'part_number' => 'required||max:10', 'product_value' => 'required', 'value_type' => 'required'], 
                    [ 'part_number' => __('messages.Part number is required'), 'product_value' => __('messages.Value is required') ]);

        ProductValueDirectDistributor::store(
            $r->only('part_number', 'product_value', 'value_type')
        );

        return Redirect::to('/produto/valor')->with('successfully', __('messages.New product value'));
    }

    // updated
    public function updated(Request $r)
    {
        $r->validate([ 'part_number' => 'required||max:10', 'product_value' => 'required', 'value_type' => 'required'], 
                     [ 'part_number' => __('messages.Part number is required'), 'product_value' => __('messages.Value is required') ]);

        ProductValueDirectDistributor::updated(
            $r->only('id','part_number', 'product_value', 'value_type')
        );

        return Redirect::to('/produto/valor')->with('successfully', __('messages.Updated product value'));
    }

    // destroy
    public static function destroy($id)
    {
        ProductValueDirectDistributor::destroy($id);

        return Redirect::to('/produto/valor')->with('successfully', __('messages.Deleted product value'));
    }
}
