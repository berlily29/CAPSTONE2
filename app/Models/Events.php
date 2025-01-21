<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;




class Events extends Model
{


    public function category() {
        return $this->hasOne(EventCategories::class,'id', 'event_category');
    }

    public function organizer(){
         return $this->hasOne(UsersLogin::class, 'user_id', 'event_organizer');
    }




    public function channel() {

        return $this-> hasOne(EventChannels::class,'event_id', 'event_id');

    }


    public function joinedUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            Users::class,
            'user_joined_events',
            'event_id',
            'user_id',
            'event_id',
            'user_id'
        );
    }



    protected $primaryKey = 'event_id';
    protected $casts = [
        'event_id'=> 'string'
    ];

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'event_category',
        'event_organizer',
        'date',
        'venue',
        'target_location',

        'status',
        'approved'
    ];

}
