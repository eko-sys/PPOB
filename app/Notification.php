<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Notification extends Model
{
    protected $fillable = [
    	'user_id',
    	'notification',
    	'is_open',
    	'from',
    	'from_id',
    	'is_open',
        'image_send'
    ];

    public function getNotification()
    {
    	$notif = DB::table('notifications')
            ->join('users', 'notifications.user_id', '=', 'users.id')
            ->where('notifications.user_id', '=' ,Auth::user()->id)
            ->select('*')
            ->limit(6)
            ->get();

        return $notif;
    }
}
