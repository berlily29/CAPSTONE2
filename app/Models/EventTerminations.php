<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTerminations extends Model
{

    public function event() {
        return $this->belongsTo(Events::class, 'event_id', 'event_id');
    }


    protected $primaryKey = 'termination_id';


    protected $casts = [
        'termination_id'=> 'string'
    ];
    protected $fillable = [
        'termination_id', 'event_id', 'reason'
    ];
}
