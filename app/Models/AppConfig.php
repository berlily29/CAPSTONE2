<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    protected $fillable = [
        'name',
        'primary_logo',
        'secondary_logo'
    ];
}
