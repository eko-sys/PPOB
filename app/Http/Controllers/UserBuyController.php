<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\ApiAtlantic;
use App\Product;
use App\User;

class UserBuyController extends Controller
{
	public function __construct()
	{
		$this->middleware('IsVerify');
	}

    public function UserPpob(Request $request)
    {	
    	$model = new ApiAtlantic;
    	$product = Product::where('product_code', $request->product)->get();
    	
    	if($product){
    		if(Auth::user()->saldo > $product[0]->price){
    			$request_api = $model->ApiPpob($request->number, $request->product);
    			if($request_api->result != false){

                    DB::table('history')->insert(
                        ['order_id' => $request_api->data->trxid , 'name' => $product[0]->product_name, 'code' => $product[0]->product_code, 'price' => $product[0]->price, 'type' => $product[0]->type, 'user_id' => Auth::user()->id, 'refund' => '1']
                    );

    				$saldo = Auth::user()->saldo - $product[0]->price;
    				User::where('id', Auth::user()->id)
				        ->update(['saldo' => $saldo]);

				    return redirect()->back()->with('message', 'Success order id product '.$request_api->data->trxid.'');
    			}else{
    				return redirect()->back()->with('failed', 'Request Gagal ('.$request_api->data.')');
    			}
    		}else{
    			return redirect()->back()->with('failed', 'Saldo Anda Tidak Cukup!!');
    		}
    	}else{
    		return redirect()->back()->with('failed', 'Product Tidak Ada!');
    	}
    }

     public function userBuyGame(Request $request)
    {
        $model = new ApiAtlantic;
        $product = DB::table('product_games')->where('code', '=', $request->game)->get();

        if($product){
            if(Auth::user()->saldo > $product[0]->price){
                $request_api = $model->productGame($request->id, $request->game);
                if($request_api->result != false){
                    $saldo = Auth::user()->saldo - $product[0]->price;

                    DB::table('history')->insert(
                        ['order_id' => $request_api->data->trxid , 'name' => ''.$product[0]->game.''. $product[0]->name.'', 'code' => $product[0]->code, 'price' => $product[0]->price, 'type' => 'game', 'user_id' => Auth::user()->id, 'refund' => '1']
                        );

                    User::where('id', Auth::user()->id)
                        ->update(['saldo' => $saldo]);

                    return redirect()->back()->with('message', 'Success order');
                }else{
                    return redirect()->back()->with('failed', 'Request Gagal ('.$request_api->data.')');
                }
            }else{
                return redirect()->back()->with('failed', 'Saldo Anda Tidak Cukup!!');
            }
        }else{
            return redirect()->back()->with('failed', 'Product Tidak Ada!');
        }
    }
}
