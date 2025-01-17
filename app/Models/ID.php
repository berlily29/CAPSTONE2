<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ID extends Model
{

    public function user() {
        return $this-> belongsTo(Users::class,'user_id', 'user_id');
    }

    protected $table = 'tbl_valid_id';

    protected $fillable = [
        'user_id',
        'id_type',
        'attachment',
        'status'
    ];


}
