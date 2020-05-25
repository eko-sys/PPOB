<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'product_name',
		'product_code',
		'price',
		'type',
		'provaider_id'
	];
}
