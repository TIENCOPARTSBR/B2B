<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserAdminController
{
    // index
    public function index()
    {
        return view('admin.user.show', ['user' => UserAdmin::get()]);
    }

    // search
    public function show(Request $r)
    {
        return view('admin.user.show', ['user' => UserAdmin::show($r->name)]);
    }

    // create
    public function create()
    {
        return view('admin.user.create');
    }

     // store
     public function store(Request $request)
     {
        UserAdmin::store($request->only('name','mail','password','is_active'));
		return Redirect::to('/admin/usuarios')->with('successfully', __('messages.User create successfully'));
     }

    // edit
    public function edit( $id )
    {
        return view('admin.user.edit', ['user' => UserAdmin::findOrFail($id)]);
    }
    
    // update
    public function updated( Request $request )
    {
        UserAdmin::updated($request->only('id','name', 'mail', 'password', 'is_active'));
		return Redirect::to('/admin/usuarios')->with('successfully', __('messages.User change successfully'));
    }

    // delete
    public function destroy( $id )
    {
        UserAdmin::destroy($id);
		return Redirect::to('/admin/usuarios')->with('successfully', __('messages.User deleted successfully'));
    }
}