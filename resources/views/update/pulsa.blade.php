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
			
			if($data->brand == 'TELKOMSEL' && $data->type == 'pulsa-reguler'){
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
              			->update(['product_name' => $data->name, 'price' => $data->price+160, 'product_name' => $data->name]);

				}else{
					DB::table('products')->insert(
				    	['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '1', 'note' => $data->note, 'category' => $data->category]
					);
				}
				
			}

			if($data->brand == 'SMART' && $data->type == 'pulsa-reguler'){

				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name, 'price' => $data->price+160]);
				}else{
					DB::table('products')->insert(
					    ['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '5', 'note' => $data->note, 'category' => $data->category]
					);
				}
			}

			if($data->brand == 'INDOSAT' && $data->type == 'pulsa-reguler'){

				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name, 'price' => $data->price+160]);
				}else{
					DB::table('products')->insert(
					    ['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '2', 'note' => $data->note, 'category' => $data->category]
					);
				}
			}

			if($data->brand == 'AXIS' && $data->type == 'pulsa-reguler'){
				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name, 'price' => $data->price+160]);
				}else{
					DB::table('products')->insert(
					    ['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '4', 'note' => $data->note, 'category' => $data->category]
					);
				}
			}

			if($data->brand == 'TRI' && $data->type == 'pulsa-reguler'){
				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name, 'price' => $data->price+160]);
				}else{
					DB::table('products')->insert(
					    ['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '3', 'note' => $data->note, 'category' => $data->category]
					);
				}
			}

			if($data->brand == 'XL' && $data->type == 'pulsa-reguler'){
				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name, 'price' => $data->price+160]);
				}else{
					DB::table('products')->insert(
					    ['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '6', 'note' => $data->note, 'category' => $data->category]
					);
				}
			}


			if($data->brand == 'BY.U' && $data->type == 'pulsa-reguler'){

				$product = DB::table('products')->where('product_code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('products')
              			->where('product_code', $data->code)
              			->update(['product_name' => $data->name, 'price' => $data->price+160]);
				}else{
					DB::table('products')->insert(
					    ['product_name' => $data->name, 'product_code' => $data->code, 'price' => $data->price+200, 'type' => 'pulsa', 'provaider_id' => '7', 'note' => $data->note, 'category' => $data->category]
					);
				}
			}
		}
    	