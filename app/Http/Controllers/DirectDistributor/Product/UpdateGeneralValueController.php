<?php

namespace App\Http\Controllers\DirectDistributor\Product;

use App\Http\Controllers\Controller;
use App\Models\DirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateGeneralValueController extends Controller
{
    public function index(DirectDistributor $distributor)
    {
        return view('direct-distributor.product.value.general-value.index')
            ->with('general', $distributor::findOrFail(Auth::guard('distributor')->user()->direct_distributor_id));
    }

    public function store(DirectDistributor $distributor, Request $request)
    {
        $distributor::findOrFail(Auth::guard('distributor')->user()->direct_distributor_id)
            ->update($request->all());

        return to_route('direct.distributor.product.value.general.value.index')
            ->with('successfully', __('messages.User deleted successfully'));
    }
}
