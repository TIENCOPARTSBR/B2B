<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController
{
    public function index(UserAdmin $user)
    {
        return view('admin.user.index')
            ->with('user', $user->all());
    }

    public function show(UserAdmin $user, Request $request)
    {
        return view('admin.user.index')
            ->with('user', $user->where('name', 'like', '%'.$request->name.'%')->get());
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserAdmin $user, Request $request)
    {
        $request->validate([
            'password' => [
                'required', 'confirmed'
            ]
		],[
			'password' => __('messages.Passwords do not match'),
		]);

        $request['password'] = Hash::make($request['password']);

        $user::create($request->all());

        return to_route('admin.user.index')
            ->with('successfully', __('messages.User create successfully'));
    }

    public function edit(UserAdmin $user, $id)
    {
        return view('admin.user.edit')
            ->with('user', $user->findOrFail($id));
    }
    
    public function updated(UserAdmin $user, Request $request)
    {
        $request['password'] = Hash::make($request['password']);

        $user->update($request->all());

		return to_route('admin.user.index')
            ->with('successfully', __('messages.User change successfully'));
    }

    public function destroy(UserAdmin $user, Request $request)
    {
        $user->findOrFail($request->id_delete)->delete();

		return to_route('admin.user.index')
            ->with('successfully', __('messages.User deleted successfully'));
    }
}