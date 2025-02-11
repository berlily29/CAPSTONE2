<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersLogin extends Authenticatable
{
    public function user() {
        return $this->hasOne(Users::class, 'user_id', 'user_id' );
    }

    public function regtoken() {
        return $this->belongsTo(RegistrationTokens::class,'email','email');
    }

    public function event() {
        return $this-> hasMany(Events::class, 'event_organizer', 'user_id');
    }

    public function pwtoken() {
        return $this->hasOne(PasswordResetTokens::class,'email','email');
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



    public static function boot() {
        parent::boot();

    }
}
