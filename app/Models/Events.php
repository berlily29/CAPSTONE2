<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{


    public function category() {
        return $this->hasOne(EventCategories::class,'id', 'event_category');
    }
    protected $primaryKey = 'event_id';
    protected $casts = [
        'event_id'=> 'string'
    ];

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'event_category',
        'date',
        'venue',
        'target_location',

        'status',
        'approved'
    ];

}
