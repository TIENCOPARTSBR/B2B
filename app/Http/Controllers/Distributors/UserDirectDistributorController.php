<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Models\UserDirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserDirectDistributorController extends Controller
{
    // index
    public function index()
    {
        return view('distributor.users.show', ['user' => UserDirectDistributor::index()]);
    }

    // show 
    public function show(Request $r)
    {
        return view('distributor.users.show', ['user' => UserDirectDistributor::show($r->only('name'))]);
    }

    // create
    public function create()
    {
        return view('distributor.users.create');
    }

    // store
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'mail' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        UserDirectDistributor::store($r->only('type', 'is_active', 'name', 'mail', 'password'));
		return Redirect::to('/usuarios')->with('successfully', __('messages.User created successfully'));
    }

    // edit 
    public function edit($id)
    {
        return view('distributor.users.edit', ['user' => UserDirectDistributor::findOrFail($id)]);
    }

    // update
    public function updated(Request $r)
    {
        UserDirectDistributor::updated($r->only('id', 'type', 'is_active', 'name', 'mail', 'password'));
		return Redirect::to('/usuarios')->with('successfully', __('messages.User changed successfully'));
    }

    // delete 
    public function destroy($id){
        UserDirectDistributor::destroy($id);
		return Redirect::to('/usuarios')->with('successfully', __('messages.User deleted successfully'));
    }
}
