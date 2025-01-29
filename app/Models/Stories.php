<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{


    public function user() {
        return $this->belongsTo(Users::class,'user_id', 'user_id');
    }

    public function channel() {
        return $this->belongsTo(EventChannels::class,'channel_id','channel_id');
    }


    protected $fillable = [
        'caption',
        'user_id' ,
        'channel_id',
        'image'
    ];
}
