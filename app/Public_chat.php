<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Public_chat extends Model
{
	protected $table = 'publics';
	
    protected $fillable = [
    	'message',
    	'name',
    	'user_id'
    ];
}
