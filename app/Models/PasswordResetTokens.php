<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetTokens extends Model
{



    public function user_auth() {
        return $this->belongsTo(UsersLogin::class, 'email','email');
    }


    protected $table = 'password_reset_tokens';
    protected $primaryKey = 'email';
    protected $fillable = [
        'email','token','created_at'
    ];

    protected $casts = [
        'email'=> 'string'
    ];



}
