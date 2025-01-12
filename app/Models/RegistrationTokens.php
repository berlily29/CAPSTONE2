<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationTokens extends Model
{

    public function login() { 
        return $this-> hasOne(UsersLogin::class, 'email', 'email'); 
    }

    protected $table = 'registration_tokens'; 
    protected $primaryKey = 'email'; 
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'email','token','created_at'
    ]; 

  

}
