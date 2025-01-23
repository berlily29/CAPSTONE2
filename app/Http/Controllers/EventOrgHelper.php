<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

use Illuminate\Support\Str;


class EventOrgHelper extends Controller
{
    public function generate_event_id() {
        do {
            $eid = Str::random(6) . '-' . Str::random(4) . '-' . Str::random(8);
        } while (Events::where('event_id', $eid)->exists());

        return $eid;
    }
}
