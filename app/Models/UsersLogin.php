<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersLogin extends Authenticatable implements JWTSubject
{
    public function user() { 
        return $this->hasOne(Users::class, 'user_id', 'user_id' ); 
    }

    public function regtoken() { 
        return $this->belongsTo(RegistrationTokens::class,'email','email'); 
    }

    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tbl_login'; 
    protected $primaryKey = 'user_id'; 
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role, 
            'sub' => $this->getKey(),
        ];
    }

    public static function boot() {
        parent::boot();

    }
}