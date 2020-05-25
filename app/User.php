<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'image', 'is_active', 'saldo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function menu()
    {
        $users = DB::table('users')
            ->join('access_menu', 'users.role_id', '=', 'access_menu.user_role')
            ->join('menu', 'access_menu.menu_id', '=', 'menu.id')
            ->where('users.id', '=', Auth::user()->id)
            ->orderBy('menu.id', 'asc')
            ->select('menu.*')
            ->get();

        return $users;
    }

    public function sub_menu()
    {
        $users = DB::table('users')
            ->join('access_menu', 'users.role_id', '=', 'access_menu.user_role')
            ->join('menu', 'access_menu.menu_id', '=', 'menu.id')
            ->join('sub_menu', 'menu.id', '=', 'sub_menu.menu_id')
            ->where('users.id', '=', Auth::user()->id)
            ->select('sub_menu.*')
            ->get();

        return $users;
    }
}
