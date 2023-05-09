<?php

namespace App\Http\Controllers\Admin;

use App\Models\DirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DirectDistributorController
{
    // index
    public function index()
    {
        return view('admin.directDistributor.show', ['distributor' => DirectDistributor::get()]);
    }

    // show
    public function show(Request $r)
    {
        return view('admin.directDistributor.show', ['distributor' => DirectDistributor::show($r->name)]);
    }

    // create
    public function create(){
        return view('admin.directDistributor.create');
    }

    // store
    public function store(Request $r)
    {
        DirectDistributor::store(
            $r->only('name','is_active','cif_freight','allow_quotation','allow_partner', 'allow_product_report')
        );
        
        return Redirect::to('/admin/distribuidor')->with('successfully', __('messages.Distributor successfully registered'));
    }

    // edit
    public function edit($id)
    {
        return view('admin.directDistributor.edit', ['distributor' => DirectDistributor::findOrFail($id)]);
    }
    
    // updated
    public function updated(Request $request)
    {
        DirectDistributor::updated(
            $request->only('id','name','is_active','cif_freight', 'allow_quotation','allow_partner','allow_product_report')
        );
        
        return Redirect::to('/admin/distribuidor')->with('successfully', __('messages.Distributor changed successfully'));
    }

    // destroy
    public function destroy($id)
    {
        DirectDistributor::destroy($id);
        return Redirect::to('/admin/distribuidor')->with('successfully', __('messages.Distributor successfully deleted'));
    }

    // general value
    public function setGeneralValue(Request $r)
    {
        DirectDistributor::setGeneralValue($r->only('option_general_value', 'general_value'));
        return Redirect::to('/produto/valor')->with('successfully', __('messages.General value of products has been updated'));
    }
}
