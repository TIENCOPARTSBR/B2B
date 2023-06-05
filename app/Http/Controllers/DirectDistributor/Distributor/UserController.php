<?php

namespace App\Http\Controllers\DirectDistributor\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(UserDistributor $user, Distributor $distributor, $id) 
    {
        return view('direct-distributor.distributor.user.index')
             ->with('distributor', $distributor::findOrFail($id))
             ->with('user', $user->where('distributor_id', $id)->paginate(10));
    }

    public function create($id)
    {
        return view('direct-distributor.distributor.user.create')
            ->with('id', $id);
    }

    public function store(UserDistributor $user, Request $request)
    {
        if(!empty($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }
        else {
            unset($request['password']);
        }
        
        $user->create($request->all());

        return to_route('direct.distributor.distributor.user.index', $request['distributor_id'])
            ->with('successfully', __('messages.User created successfully'));
    }

    public function edit(UserDistributor $user, $id)
    {
        return view('direct-distributor.distributor.user.edit')
            ->with('id', $id)
            ->with('user', $user->findOrFail($id));
    }

    public function updated(UserDistributor $user, Request $request)
    {
        if(!empty($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }
        else {
            unset($request['password']);
        }
        
        $user = $user->findOrFail($request['id']);
        $user->update($request->all());

        return to_route('direct.distributor.distributor.user.index', $user['distributor_id'])
            ->with('successfully', __('messages.User changed successfully'));
    }

    public function destroy(UserDistributor $user, Request $request)
    {
        $user::findOrFail($request['id_delete'])->delete();

		return back()
            ->with('successfully', __('messages.User deleted successfully'));
    }
}
