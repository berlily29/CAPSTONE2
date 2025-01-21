<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsChannelController extends Controller
{
    public function index($id) {
        return view('user.channel.view')->with([
            'event'=> Events::where('event_id', $id)->first()
        ]);
    }
}
