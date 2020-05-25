<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Notification;
use App\Public_chat;

class DashboardController extends Controller
{

    public function index()
    {

        $notification = new Notification;
        $notifications = $notification->getNotification();

        $informations = DB::table('informations')->select('*')->get();

    	$model = new User;
    	$menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('dashboard.index', [
            'menus' => $menu, 
            'sub_menus' => $sub_menu,
            'informations' => $informations,
            'notifications' => $notifications
        ]);
    }

    public function profile()
    {   

        $notification = new Notification;
        $notifications = $notification->getNotification();

        $informations = DB::table('informations')->get();
        
        $trx = DB::table('history')->where('user_id', '=', Auth::user()->id)->get();
    	$model = new User;
    	$menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('users.profile', [
            'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications,
            'informations' => $informations,
            'trx'   => $trx
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        
        $request->validate([
            'name' => 'min:4|max:12',
            'password' => 'min:6|max:12|confirmed',
            'avatar' => 'file|image|max:1528'
        ]);

        if($request->file('avatar')){
            $file = $request->file('avatar');
            $file->move('img/profile', "".date('YmdHis')."".$file->getClientOriginalName()."");

            User::where('id', $id)
            ->update(['image' => "".date('YmdHis')."".$file->getClientOriginalName().""]);
        }

        User::where('id', $id)
            ->update(['name' => $request->name, 'password' => bcrypt($request->password) ]);

        return redirect('/profile')->with('message', 'Your Profile Successfully Update');
    }

    public function chatPublic()
    {
        $notification = new Notification;
        $notifications = $notification->getNotification();

        $informations = DB::table('informations')->get();

        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('chats.public', [
            'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications,
            'public_chats' => Public_chat::latest()->paginate(7),
            'informations' => $informations
        ]);
    }

    public function sendMessage(Request $request)
    {
        Public_chat::create([
            'message' => $request->message,
            'name' => $request->user,
            'user_id' => $request->id
        ]);

        return response()->json(['msg' => $request->all()]);
    }

    public function showPublicRefresh()
    {
        $chats = Public_chat::all();
        return view('chats.publicRefresh', [
            'publics' => $chats
        ]);
    }

    

    public function verifyEmail()
    {
        $notification = new Notification;
        $notifications = $notification->getNotification();

        if(Auth::user()->is_active == 3){
            return redirect()->back();
        }

        $informations = DB::table('informations')->get();

        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('users.emailVerify', [
            'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications,
            'informations' => $informations
        ]);
    }

    public function getCode()
    {
       $timeout = DB::table('email_verify')
           ->where('user_id', '=', Auth::user()->id )
           ->where(function ($query) {
               $query->where('time', '<', time());
           })
           ->get();

        if(count($timeout) > 0){
            DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->delete();
        }else{
            $user = DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->get();
            if(count($user) > 0){
                    $timeout = $user[0]->time;
                    $time = $timeout - time();

                    return redirect()->back()->with('failed', 'Silahkan Tunggu Selama '. date('s', $time) .' Detik Untuk Mendapatkan Kode Lagi!');
            }
            
        }

        $time = date('s');
        $code = "". rand('001','999')."".$time."";

        if( DB::table('email_verify')->insert(
            ['user_id' => Auth::user()->id , 'code' => $code, 'time' => time() + 60 * 1]
        )) {
            $user = DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->get();
            $data = [
                'code' => $user[0]->code,
                'name' => Auth::user()->name
            ];

            Mail::to(Auth::user()->email)->send(new EmailVerification($data));
        }

        return redirect()->back()->with('message', 'Succes To Send, Check Your Email Inbox!');
    }

    public function getVerify(Request $request)
    {
        if($request->all() == null){
            return redirect()->back();
        }

        $user = DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->get();
        $code = DB::table('email_verify')->where('code', '=', $request->code )->get();

        if( count($user) > 0 ){
            if(count($code) > 0 ){
                DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->delete();

                User::where('id', Auth::user()->id)
                  ->update(['is_active' => 3]);

                return redirect('/home')->with('message', 'Your Email Success To Verified');
            }else{
                return redirect('/home')->with('failed','Kode Salah!');
            }
           
        }else{
            return redirect('/home')->with('failed', 'User Not Found!');
        }
    }

    public function postVerify(Request $request)
    {
        $request->validate([
            'code' => 'required|min:5|max:5'
        ]);

        $user = DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->get();
        $code = DB::table('email_verify')->where('code', '=', $request->code )->get();

        if( count($user) > 0 ){
            if(count($code) > 0 ){
                DB::table('email_verify')->where('user_id', '=', Auth::user()->id)->delete();

                User::where('id', Auth::user()->id)
                  ->update(['is_active' => 3]);

                return redirect('/home')->with('message', 'Your Email Success To Verified! :)');
            }else{
                return redirect('/home')->with('failed','Kode Salah!');
            }
           
        }else{
            return redirect('/home')->with('failed', 'User Not Found!');
        }
    }

    public function support()
    {
        $notification = new Notification;
        $notifications = $notification->getNotification();

        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('dashboard.support',[
            'menus' => $menu, 
            'sub_menus' => $sub_menu,
            'notifications' => $notifications
        ]);
        return view('dashboard.support');
    }
}