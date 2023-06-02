<?php

namespace App\Http\Controllers\DirectDistributor\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserDirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDirectDistributor $user)
    {
        return view('direct-distributor.user.index')
            ->with('user', $user
                            ->where('direct_distributor_id', Auth::guard('distributor')->user()->direct_distributor_id)
                            ->paginate(10));
    }

    public function show(UserDirectDistributor $user, Request $request)
    {
        return view('direct-distributor.user.index')
            ->with('user', $user
                            ->where('name', 'LIKE', $request->only('name'))
                            ->where('direct_distributor_id', Auth::guard('distributor')->user()->direct_distributor_id)
                            ->paginate(10));
    }

    public function create()
    {
        return view('direct-distributor.user.create');
    }

    public function store(UserDirectDistributor $user, Request $request)
    {
        $user->create($request->all());

		return to_route('direct.distributor.user.index')
            ->with('successfully', __('messages.User created successfully'));
    }

    public function edit(UserDirectDistributor $user, $id)
    {
        return view('direct-distributor.user.edit')
            ->with('user', $user->findOrFail($id));
    }

    public function updated(UserDirectDistributor $user, Request $request)
    {
        if(!empty($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }
        else {
            unset($request['password']);
        }
        
        $user->findOrFail($request->id)->update($request->all());

		return to_route('direct.distributor.user.index')
            ->with('successfully', __('messages.User changed successfully'));
    }

    public function destroy(UserDirectDistributor $user, Request $request)
    {
        $user::findOrFail($request->id_delete)->delete();

		return to_route('direct.distributor.user.index')
            ->with('successfully', __('messages.User deleted successfully'));
    }
}
