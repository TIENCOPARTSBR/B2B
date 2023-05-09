<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserDistributor extends Model
{
    use HasFactory;

    protected $table = 'user_distributor';

    protected $fillable = [
        'name',
        'mail',
        'password',
        'is_active',
        'id_distributor'
    ];

    // create
    public static function store($r)
    {
        $user = [
            'name' => $r['name'],
            'mail' => $r['mail'],
            'password' => Hash::make($r['password']),
            'is_active' => $r['is_active'],
            'id_distributor' => $r['id_distributor']
        ];

        if($r['password'] === '') unset($user['password']);

        UserDistributor::create($user);
    }

    // show
    public static function show( $name )
    {
        $user = UserDistributor::where('name', 'like', '%'.$name.'%')->get();
        return $user;
    }

    // update
    public static function updated($r)   
    {
        $user = UserDistributor::findOrFail($r['id']);
        $user->name = $r['name'];
        $user->mail = $r['mail'];
        $user->is_active = $r['is_active'];
        if($r['password'] === '') $user->password = Hash::make($r['password']);
        $user->update();
    }


    // destroy
    public static function destroy($id) 
    {
        UserDistributor::findOrFail($id)->delete();
    }
}
