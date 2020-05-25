<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiAtlantic extends Model
{
    public function ApiPpob($nomor, $code)
    {
		$api_key = "12fb0b20c2d55ebef8e1bfb888aa36131efe7ebb563eb4f3af0d38b943861968"; // Change with Your API Key
		$api_url = "https://atlantic-pedia.co.id/api/pulsa";
		$param = array( 
		  'key'		=> $api_key, 
		  'action'	=> 'order',
		  'service'	=> $code, // Examples trx_code, you can change it
		  'target'	=> $nomor
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
		return $response;
    }

    public function statusPpob($trx)
    {
    	$api_key = "12fb0b20c2d55ebef8e1bfb888aa36131efe7ebb563eb4f3af0d38b943861968"; // Change with Your API Key
		$api_url = "https://atlantic-pedia.co.id/api/pulsa";
		$param = array( 
		  'key'		=> $api_key, 
		  'action'	=> 'status',
		  'trxid'	=> $trx
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
		return $response;
    }

    public function productGame($id, $code)
    {

    	$api_key = "12fb0b20c2d55ebef8e1bfb888aa36131efe7ebb563eb4f3af0d38b943861968"; // Change with Your API Key
		$api_url = "https://atlantic-pedia.co.id/api/game";
		$param = array( 
		  'key'		=> $api_key, 
		  'action'	=> 'order',
		  'service'	=> $code,
		  'target'	=> $id
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
		return $response;
    	
    }

}
