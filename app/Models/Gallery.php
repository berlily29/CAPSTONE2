<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected function channel() {
        return $this->belongsTo(EventChannels::class, 'channel_id', 'channel_id');
    }



    protected $fillable = [
        'channel_id'
    ];
}
