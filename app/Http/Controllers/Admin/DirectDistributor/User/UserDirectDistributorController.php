<?php

namespace App\Http\Controllers\Admin\DirectDistributor\User;

use App\Models\DirectDistributor;
use App\Models\UserAdmin;
use App\Models\UserDirectDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDirectDistributorController
{
    public function index(UserDirectDistributor $user, DirectDistributor $direct_distributor, $id)
    {
        return view('admin.direct-distributor.user.index')
            ->with('distributor', $direct_distributor->findOrFail($id))
            ->with('user', $user
                            ->where('direct_distributor_id', $id)
                            ->get());
    }

    public function show(UserDirectDistributor $user, DirectDistributor $direct_distributor, $id, Request $request)
    {
        return view('admin.direct-distributor.user.index')
            ->with('distributor', $direct_distributor->findOrFail($id))
            ->with('user',  $user
                            ->where('direct_distributor_id', $id)
                            ->where('name', 'like', '%'.$request->name.'%')
                            ->get());
    }

    public function create(DirectDistributor $direct_distributor, $id)
    {
        return view('admin.direct-distributor.user.create')
            ->with('distributor', $direct_distributor->findOrFail($id));
    }

    public function store(UserDirectDistributor $user_direct_distributor, Request $request)
    {
        $request->validate([
            'password' => [
                'required', 'confirmed'
            ]
		],[
			'password' => __('messages.Passwords do not match'),
		]);

        $request['password'] = Hash::make($request['password']);

        $user_direct_distributor::create($request->all());

        return to_route('admin.direct.distributor.user.index', $request->direct_distributor_id)
            ->with('successfully', __('messages.User create successfully'));
    }

    public function edit(UserDirectDistributor $user, $id)
    {
        return view('admin.direct-distributor.user.edit')
            ->with('user', $user->findOrFail($id));
    }
    
    public function updated(UserDirectDistributor $user, Request $request)
    {
        $request['password'] = Hash::make($request['password']);

        $user->update($request->all());

		return to_route('admin.direct.distributor.user.index', $request->direct_distributor_id)
            ->with('successfully', __('messages.User change successfully'));
    }

    public function destroy(UserDirectDistributor $user, Request $request)
    {
        $user->findOrFail($request->id_delete)->delete();

		return back()
            ->with('successfully', __('messages.User deleted successfully'));
    }
}