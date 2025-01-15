<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ID extends Model
{

    protected $table = 'tbl_valid_id';

    protected $fillable = [
        'user_id',
        'id_type',
        'attachment',
        'status'
    ];


}
