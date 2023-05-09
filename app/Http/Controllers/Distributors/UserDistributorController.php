<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Models\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserDistributorController extends Controller
{
    // index
    public function index()
    {
        return view('distributor.users.show', ['users' => UserDistributor::all()]);
    }
    
    // show
    public function show($id){
        return view('distributor.distributors.users.create', ['idDirectDistributor' => $id]);
    }

    // store
    public function store(Request $r){
        UserDistributor::store(
            $r->only('id_distributor', 'name', 'mail', 'password', 'is_active')
        );
        
        return Redirect::to('/distribuidor/visualizar/'.$r->id_distributor)->with('successfully', __('messages.User created successfully'));
    }

    // edit
    public function edit($id){
        return view('distributor.distributors.users.edit', ['user' => UserDistributor::findOrFail($id)]);
    }

    // update
    public function updated(Request $request){
        UserDistributor::updated($request->only('id', 'name', 'mail', 'password', 'is_active'));
        return Redirect::to('/distribuidor/visualizar/'.$request->id_distributor)->with('successfully', __('messages.User changed successfully'));
    }

    // delete
    public function destroy($id){
        UserDistributor::destroy($id);
        return redirect()->back()->with('successfully', __('messages.User deleted successfully'));
    }
}
