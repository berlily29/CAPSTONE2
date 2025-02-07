<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    public function readers() {
        return $this->hasMany(AnnouncementsReaders::class, 'post_id', 'post_id');
    }

    public function channel() {
        return $this-> belongsTo(EventChannels::class, 'channel_id', 'channel_id');
    }

    public function story() {
        return $this-> hasMany(Stories::class,'channel_id', 'channel_id');
    }

    public function getTotalReadersAttribute()
    {
        // Count the number of related readers
        return $this->readers()->count();
    }



    protected $primaryKey = 'post_id';
    protected $fillable = [
        'post_id',
        'title',
        'content',
        'images',
        'channel_id'
    ];
}
