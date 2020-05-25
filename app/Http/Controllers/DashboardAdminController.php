<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notification;
use Auth;
use App\Product;

class DashboardAdminController extends Controller
{
    public function index()
    {
    	return  'hecked';
    }

    public function userEdit()
    {
        $users = User::all();

        $notification = new Notification;
        $notifications = $notification->getNotification();

    	$model = new User;
    	$menu = $model->menu();
        $sub_menu = $model->sub_menu();

    	return view('admin.user-edit',[
            'users' => $users,
            'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications
        ]);
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);

        return response()->json(['msg' => $user]);
    }

    public function userUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::where('id', $request->id)
            ->update(['name' => $request->name, 'email' => $request->email,'saldo' => $request->saldo, 'is_active' => $request->active, 'role_id' => $request->role_id ]);

        return redirect()->back()->with('message', 'Success Updated!');
    }

    public function notification()
    {
        $users = User::all();

        $notification = new Notification;
        $notifications = $notification->getNotification();

        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('admin.notification',[
            'users' => $users, 
            'menus' => $menu, 
            'sub_menus' => $sub_menu,
            'notifications' => $notifications
        ]);
    }

    public function sendNotif(Request $request)
    {
        $request->validate([
            'notif' => 'required'
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'notification' => $request->notif,
            'from' => Auth::user()->name,
            'from_id' => Auth::user()->id,
            'is_open' => 0,
            'image_send' => Auth::user()->image
        ]);

        return redirect()->back();
    }

    public function productEdit()
    {

        $notification = new Notification;
        $notifications = $notification->getNotification();

        $products = Product::all();

        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('admin.productEdit',[
            'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications,
            'products' => $products
        ]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'price' => 'required'
        ]);

        $product_code = strtoupper($request->code);

        Product::create([
            'product_name' => $request->name,
            'product_code' => $product_code,
            'price' => $request->price,
            'type' => $request->type,
            'provaider_id' => $request->provaider,
            'note' => $request->note,
            'category' => $request->category
        ]);

        return redirect()->back();
        
    }

    public function updatingProduct(Request $request)
    {
        
        Product::where('product_code', $request->code)
          ->update(['product_name' => $request->name, 'price' => $request->price, 'type' => $request->type, 'provaider_id' => $request->provaider]);

        return redirect()->back()->with('message', 'Success Updated!');
    }

    public function updatePulsa(Request $request)
    {
        return view('update.pulsa');
    }

    public function updateData(Request $request)
    {
        return view('update.paket-data');
    }

    public function updateVData(Request $request)
    {
        return view('update.vdata');
    }

    public function updateEmoney()
    {
        return view('update.e-money');
    }

    public function updateGame()
    {
        return view('update.game');
    }
}
