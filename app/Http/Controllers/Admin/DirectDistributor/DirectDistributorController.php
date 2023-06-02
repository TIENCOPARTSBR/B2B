<?php

namespace App\Http\Controllers\Admin\DirectDistributor;

use App\Models\DirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DirectDistributorController
{
    public function index()
    {
        return view('admin.direct-distributor.index', ['distributor' => DirectDistributor::all()]);
    }

    public function show(Request $request)
    {
        return view('admin.direct-distributor.index')
            ->with('distributor', DirectDistributor::where('name','like', '%'.$request->name.'%')->get());
    }

    public function create(){
        return view('admin.direct-distributor.create');
    }

    public function store(Request $request)
    {
        DirectDistributor::create($request->all());
        
        return to_route('admin.direct.distributor.index')
            ->with('successfully', __('messages.Distributor successfully registered'));
    }

    public function edit($id)
    {
        return view('admin.direct-distributor.edit')
            ->with('distributor', DirectDistributor::findOrFail($id));
    }
    
    public function updated(Request $request)
    {
        DirectDistributor::findOrFail($request->id)->update($request->all());
        
        return to_route('admin.direct.distributor.index')
            ->with('successfully', __('messages.Distributor changed successfully'));
    }

    public function destroy(Request $request)
    {
        DirectDistributor::findOrFail($request->id_delete)->delete();
        return to_route('admin.direct.distributor.index')
            ->with('successfully', __('messages.Distributor successfully deleted'));
    }
}
