<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Su_admin extends Model
{
    protected $table = 'su_admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

     protected $hidden = [
        'password'
    ];
}
