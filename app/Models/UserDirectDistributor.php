<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserDirectDistributor extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_direct_distributor';

    protected $fillable = [
        'type',
        'name',
        'mail',
        'password',
        'is_active',
        'id_direct_distributor',
    ];

    // index
    public static function index(){
        $user = UserDirectDistributor
                    ::where('id_direct_distributor', Auth::user()->id_direct_distributor)
                    ->paginate(10);
        return $user;
    }

    // show
    public static function show($r)
    {
        $user = UserDirectDistributor
                    ::where('name', 'LIKE', '%'.$r['name'].'%')
                    ->where('id_direct_distributor',Auth::user()->id_direct_distributor)
                    ->paginate(10);
        return $user;
    }

    // store
    public static function store($r)
    {
        $user = [
            'id_direct_distributor' => Auth::user()->id_direct_distributor,
            'is_active' => $r['is_active'],
            'type' => $r['type'],
            'name' => $r['name'],
            'mail' => $r['mail'],
            'password' => Hash::make($r['password']),
        ];

        if($r['password'] === '') unset($user['password']);

        UserDirectDistributor::create($user);
    }

    // updated
    public static function updated($r)
    {
        $user = UserDirectDistributor::findOrFail($r['id']);
        $user->type = $r['type'];
        $user->is_active = $r['is_active'];
        $user->name = $r['name'];
        $user->mail = $r['mail'];

        if($r['password'] === '') $user->password = Hash::make($r['password']);
  
        $user->update();
    }

    // destroy
    public static function destroy($id)
    { 
        UserDirectDistributor::findOrFail($id)->delete();
    }
}
