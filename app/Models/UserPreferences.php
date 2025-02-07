<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreferences extends Model
{
    public function user() {
        return $this->belongsTo(Users::class,'user_id', 'user_id');
    }
    protected $casts = [
        'preferences'=> 'array'
    ];

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id','preferences'
    ];



}
