<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Users extends Model
{


    public function login() {
        return $this->belongsTo(UsersLogin::class, 'user_id', 'user_id');
    }

    public function id() {
        return $this->hasOne(ID::class,'user_id', 'user_id');
    }

    public function getFullnameAttribute()
{
    return $this->lname . ', ' . $this->fname . ' ' . $this->mname;
}


    public function story(){
        return $this->hasMany(Stories::class,'user_id', 'user_id');
    }



    public function joinedEvents(): BelongsToMany
    {
        return $this->belongsToMany(
            Events::class,
            'user_joined_events',
            'user_id',
            'event_id',
            'user_id',
            'event_id'
        );
    }

    public function attendance_token() {
        return $this->hasMany(AttendanceTokens::class,'user_id', 'user_id');
    }


    public function notification() { 
        return $this-> hasMany(Notifications::class, 'user_id', 'user_id'); 
    }


    protected $table = 'tbl_user_info';
    protected $primaryKey = 'user_id'; // Specify the primary key
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'age',
        'gender',
        'house_no',
        'street',
        'brgy',
        'city',
        'province',
        'postal_code',
        'mobile_no',
        'profile_picture',
        'profile_points',
        'verified_status',
        'account_status'
    ];

}
