<?php

namespace App\Http\Controllers\Distributor\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDistributor $user)
    {
        return view('distributor.user.index')
            ->with('user', $user
                            ->where('distributor_id', Auth::guard('distributor')->user()->distributor_id)
                            ->paginate(10));
    }

    public function show(UserDistributor $user, Request $request)
    {
        return view('distributor.user.index')
            ->with('user', $user
                            ->where('name', 'LIKE', $request->only('name'))
                            ->where('distributor_id', Auth::guard('distributor')->user()->distributor_id)
                            ->paginate(10));
    }

    public function create()
    {
        return view('distributor.user.create');
    }

    public function store(UserDistributor $user, Request $request)
    {
        $user->create($request->all());

		return to_route('distributor.user.index')
            ->with('successfully', __('messages.User created successfully'));
    }

    public function edit(UserDistributor $user, $id)
    {
        return view('distributor.user.edit')
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
        
        $user->findOrFail($request->id)->update($request->all());

		return to_route('distributor.user.index')
            ->with('successfully', __('messages.User changed successfully'));
    }

    public function destroy(UserDistributor $user, Request $request)
    {
        $user::findOrFail($request->id_delete)->delete();

		return to_route('distributor.user.index')
            ->with('successfully', __('messages.User deleted successfully'));
    }
}
