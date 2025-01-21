<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventChannels extends Model
{
    public function event() {
        return $this->belongsTo(Events::class,'event_id', 'event_id');
    }

    public function announcement() {
        return $this->hasMany(Announcements::class, 'channel_id', 'channel_id');
    }

    protected $primaryKey = 'event_id';
    protected $fillable = [
        'channel_id', 'event_id'
    ];



}
