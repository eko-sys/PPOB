<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'user_id',
    	'Message',
    	'is_open',
    	'from'
    ];

    
}
