<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementsReaders extends Model
{
    // Define the relationship with the UsersLogin model
    public function user() {
        return $this->belongsTo(UsersLogin::class, 'user_id', 'user_id');
    }

    // Define the relationship with the Announcements model
    public function announcement() {
        return $this->belongsTo(Announcements::class, 'post_id', 'post_id');
    }

    protected $table = 'announcements_readers';

    protected $fillable = [
        'post_id' , 'user_id'
    ];
}
