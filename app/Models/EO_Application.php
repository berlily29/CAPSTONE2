<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EO_Application extends Model
{
    protected $table = 'tbl_eo_application';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'attachment',
        'status'
    ];

    public function user() {
        return $this->belongsTo(Users::class,'user_id', 'user_id');
    }

}
