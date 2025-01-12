<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreferences extends Model
{
    protected $casts = [
        'preferences'=> 'array'
    ];

    protected $fillable = [
        'user_id','preferences'
    ];



}
