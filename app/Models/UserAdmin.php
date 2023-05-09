<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_admin';

    protected $fillable = [
        'name',
        'mail',
        'password',
        'is_active'
    ];

    // store
    public static function store($r){
        $user = [
            'name' => $r['name'],
            'mail' => $r['mail'],
            'password' => Hash::make($r['password']),
            'is_active' => $r['is_active']
        ];

        if($r['password'] === '') unset($user['password']);

        UserAdmin::create($user);
    }

    // show
    public static function show($name)
    {
        return UserAdmin::select('*')->where('name', 'like', '%'.$name.'%')->get();
    }

    // updated
    public static function updated($r)   
    {
        $user = UserAdmin::findOrFail($r['id']);
        $user->name = $r['name'];
        $user->mail = $r['mail'];
        if($r['password'] === '') $user->password = Hash::make($r['password']);
        $user->is_active = $r['is_active'];
        $user->update();
    }

    // deleted
    public static function destroy($id){
        UserAdmin::findOrFail($id)->delete();
    }
}
