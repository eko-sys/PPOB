<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function index()
    {
    	return view('login.index');
    }

    public function register()
    {
    	if( session('register') ){
    		return redirect('/')->with('failed', 'Kamu telah membuat akun, Kamu tidak diperbolehkan membuat akun lagi untuk sesaat!');
    	}

    	return view('register.index');
    }
}
