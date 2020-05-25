<?php
		$api_key = "12fb0b20c2d55ebef8e1bfb888aa36131efe7ebb563eb4f3af0d38b943861968"; // Change with Your API Key
		$api_url = "https://atlantic-pedia.co.id/api/pulsa";
		$param = array( 
		  'key'		=> $api_key, 
		  'action'	=> 'services',
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
		$i = 1;
		foreach ($response->data as $data) {
			
			if($data->brand == 'GO PAY' && $data->type == 'saldo-emoney'){
				echo "<ul>
					<li>$data->category</li>
					<li>$data->brand</li>
					<li>$data->name</li>
					<li>$data->code</li>
					<li>$data->price</li>
					<li>$data->type</li>
					<li>$data->status</li>
					<li>$data->note</li>
				</ul>";

				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name,'type' => 'e-money', 'price' => $data->price+230, 'product_name' => $data->name]);

				}else{
					DB::table('products')->insert(
				    	['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '10', 'note' => $data->note, 'category' => $data->category]
					);
				}
				
			}

			if($data->brand == 'DANA' && $data->type == 'saldo-emoney'){
				echo "<ul>
					<li>$data->category</li>
					<li>$data->brand</li>
					<li>$data->name</li>
					<li>$data->code</li>
					<li>$data->price</li>
					<li>$data->type</li>
					<li>$data->status</li>
					<li>$data->note</li>
				</ul>";

				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name,'type' => 'e-money', 'price' => $data->price+230,'provaider_id' => '12', 'product_name' => $data->name]);

				}else{
					DB::table('products')->insert(
				    	['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'e-money', 'provaider_id' => '12', 'note' => $data->note, 'category' => $data->category]
					);
				}
				
			}

			if($data->brand == 'OVO' && $data->type == 'saldo-emoney'){
				echo "<ul>
					<li>$data->category</li>
					<li>$data->brand</li>
					<li>$data->name</li>
					<li>$data->code</li>
					<li>$data->price</li>
					<li>$data->type</li>
					<li>$data->status</li>
					<li>$data->note</li>
				</ul>";

				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name,'type' => 'e-money', 'price' => $data->price+230,'provaider_id' => '11', 'product_name' => $data->name]);

				}else{
					DB::table('products')->insert(
				    	['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'e-money', 'provaider_id' => '11', 'note' => $data->note, 'category' => $data->category]
					);
				}
				
			}


		}
    	