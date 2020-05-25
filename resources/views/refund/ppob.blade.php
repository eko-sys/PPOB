	
<?php
	foreach($refund as $product){

		$api_key = "12fb0b20c2d55ebef8e1bfb888aa36131efe7ebb563eb4f3af0d38b943861968"; // Change with Your API Key
		$api_url = "https://atlantic-pedia.co.id/api/pulsa";
		$param = array( 
		  'key'		=> $api_key, 
		  'action'	=> 'status',
		  'trxid'	=> $product->order_id
		);

		$_data = [];
		foreach ($param as $name => $value)
		{
		  $_data[] = $name.'='.urlencode($value);
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_data));
		$result = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($result);


		if($response->data->status == 'error'){
			DB::table('history')
       			->where('order_id', $product->order_id)
           		->update(['refund' => 0]);

				$result_saldo = ($user->saldo += $product->price);
			}
        
    }
    	
    	if(isset($result_saldo)){
    		DB::table('users')
           	->where('id', $user->id)
       		->update(['saldo' => $result_saldo]);

    	}
      	
