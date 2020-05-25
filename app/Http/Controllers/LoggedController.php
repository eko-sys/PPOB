<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class LoggedController extends Controller
{
    public function login(Request $request)
    {
    	$request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    	
    	if( Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]) )
    	{
            if( Auth::user()->is_active == '1' || Auth::user()->is_active == '3' ){

    		return redirect('/home');

            }else{
                Auth::logout();
                return redirect()->back()->with('failed', 'Akun anda telah dinonaktifkan silahkan hubungi administrator!!');
            }
            
 		}else
 		{
 			return redirect()->back()->with('failed', 'Email atau password anda salah!');
 		}
    	
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/')->with('message', 'You Have Been Log out!');
    }
}
