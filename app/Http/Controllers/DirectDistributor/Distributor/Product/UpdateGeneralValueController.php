<?php

namespace App\Http\Controllers\DirectDistributor\Distributor\Product;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateGeneralValueController extends Controller
{
    public function index(Distributor $distributor, $id)
    {
        $distributor = $distributor::where('id', $id)
            ->where('direct_distributor_id', Auth::guard('direct-distributor')->user()->id)
            ->first();

        return view('direct-distributor.distributor.value.general-value.index')
            ->with('general', $distributor)
            ->with('id', $id);
    }

    public function store(Distributor $distributor, Request $request)
    {
        $distributor::findOrFail($request->id)
            ->update($request->all());

        return back()
            ->with('successfully', __('messages.General value of products has been updated'));
    }
}
