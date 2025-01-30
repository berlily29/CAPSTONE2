<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    public function user() { 
        return $this-> belongsTo(Users::class,'user_id','user_id'); 
    }
    protected $fillable= [ 
        'caption', 
        'user_id',  
        'channel_id'
    ];
}
