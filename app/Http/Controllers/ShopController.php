<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Notification;
use App\Public_chat;
use App\Product;
use App\Provaider;
use App\ApiAtlantic;

class ShopController extends Controller
{
    public function index()
    {
    	$notification = new Notification;
        $notifications = $notification->getNotification();

        $informations = DB::table('informations')->get();
        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        $game = Provaider::where('type', 'game')->get();
        $emoney = Provaider::where('type', 'emoney')->get();

    	return view('shop.ppob',[
    		'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications,
            'emoney' => $emoney,
            'game' => $game,
            'informations' => $informations
    	]);
    }

    public function userSelect(Request $request)
    {   

        if(in_array($request->number, ['0838','0831','0832','0833
            ']))
        {            
            return response()->json(['msg' => 4, 'type' => $request->type]); //axis

        }else if(in_array($request->number, ['0811', '0812', '0813', '0821', '0822', '0852', '0853', '0823'])) {

            return response()->json(['msg' => 1, 'type' => $request->type]); //tsel

        }else if(in_array($request->number, ['0814', '0815', '0816', '0855', '0856', '0857', '0858'])){

            return response()->json(['msg' => 2, 'type' => $request->type]); //isat

        }else if(in_array($request->number, ['0895', '0896', '0897', '0898', '0899'])){

            return response()->json(['msg' => 3, 'type' => $request->type]); //3

        }else if(in_array($request->number, ['0881', '0882', '0883', '0884', '0885
            ', '0886', '0887', '0888', '0889'])){

            return response()->json(['msg' => 5, 'type' => $request->type]); // sm

        }else if(in_array($request->number, ['0817', '0818', '0819', '0859', '0877', '0878'])){

            return response()->json(['msg' => 6, 'type' => $request->type]); //xl
        
        }else if(in_array($request->number, ['0851'])){

            return response()->json(['msg' => 7, 'type' => $request->type]); //xl
        }

       


    }

    public function showSelect($id, $type)
    {
        $products = DB::table('products')
           ->where('products.provaider_id', '=', $id)
           ->where('products.type', '=', $type)
           ->select('*')
           ->get(); 

        return view('shop.showMobileProduct', compact('products'));
    }

    public function showPrice(Request $request)
    {
        $product_code = $request->code;
        $product = DB::table('products')->where('product_code', '=', $product_code)
                 ->orderBy('price', 'asc')
                ->get();

        return response()->json(['msg' => $product]);
    }

    public function eMoney(Request $request)
    {
        $products = DB::table('provaiders')
            ->join('products', 'provaiders.id', '=', 'products.provaider_id')
            ->where('provaiders.id', '=', $request->product)
            ->select('*')
            ->get();

        return response()->json(['msg' => $products]);
    }

    public function showPriceMoney(Request $request)
    {
        
        $price = Product::where('product_code', $request->id)->get();

        return response()->json(['msg' => $price]);
    }

    public function showGame(Request $request)
    {
        $games = DB::table('product_games')
            ->where('id_game', '=', $request->game)
            ->select('*')
            ->get();

        return response()->json(['msg' => $games]);
    }

    public function showPriceGame(Request $request)
    {
        $price = DB::table('product_games')
            ->where('code', '=', $request->code)
            ->select('*')
            ->get();

        return response()->json(['msg' => $price]);
    }

    public function historyTransaksi()
    {
        $notification = new Notification;
        $notifications = $notification->getNotification();

        $history = DB::table('history')->where('user_id', '=', Auth::user()->id)->limit(10)->get();
        $model = new User;
        $menu = $model->menu();
        $sub_menu = $model->sub_menu();

        return view('transaksi.ppob',[
            'menus' => $menu,
            'sub_menus' => $sub_menu,
            'notifications' => $notifications,
            'history' => $history
        ]);
    }

    public function statusOrder(Request $request)
    {
        $order = new ApiAtlantic;       
        $history = DB::table('history')->where('order_id', '=', $request->trx)->get();
        
        if($request->type == 'game'){
            $result = $order->productGame($request->trx);
        }else{
            $result = $order->statusPpob($request->trx);
        }

        if($history[0]->refund == '1'){

            if($result->data->status == 'error'){
                DB::table('history')
                    ->where('order_id', $request->trx)
                    ->update(['refund' => 0]);

                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['saldo' => Auth::user()->saldo + $history[0]->price ]);

            }else{
                
            }
        }

        return response()->json(['msg' => $result]);
    }

    public function refund()
    {
        $refund = DB::table('history')->where('refund', '=', 1)->get();

        if(count($refund) > 0){
            return view('refund.ppob', [
                'refund' => $refund,
                'user' => Auth::user()
            ]);

            return response()->json(['msg' => 'Terdapat Transaksi Yang Gagal Saldo Di Refund!!']);
        }
        
    }
}
