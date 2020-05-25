<?php
		$api_key = "12fb0b20c2d55ebef8e1bfb888aa36131efe7ebb563eb4f3af0d38b943861968"; // Change with Your API Key
		$api_url = "https://atlantic-pedia.co.id/api/game";
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
		
		foreach ($response->data as $data) {
			
			
				echo "
					<ul>
						<li>game: ".$data->game."</li>
						<li>name: ".$data->name."</li>
						<li>server: ".$data->server."</li>
						<li>code: ".$data->code."</li>
						<li>price: ".$data->price."</li>
						<li>status ".$data->status."</li>
						</ul>
					";

					

			if($data->game == 'Free Fire'){
				$product = DB::table('product_games')->where('code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('product_games')
              			->where('code', $data->code)
              			->update(['name' => $data->name, 'price' => $data->price+500]);
				}else{
					DB::table('product_games')->insert(
					    ['name' => $data->name, 'game' => $data->game, 'price' => $data->price+500, 'id_game' => '20', 'status' => $data->status, 'code' => $data->code, 'server' => $data->server]
					);
				}
			}

			if($data->game == 'Mobile Legends'){
				$product = DB::table('product_games')->where('code', '=', $data->code)->get();

				if(count($product) > 0){
					DB::table('product_games')
              			->where('code', $data->code)
              			->update(['name' => $data->name, 'price' => $data->price+500]);
				}else{
					DB::table('product_games')->insert(
					    ['name' => $data->name, 'game' => $data->game, 'price' => $data->price+500, 'id_game' => '21', 'status' => $data->status, 'code' => $data->code, 'server' => $data->server]
					);
				}
			}


		
		}
    	