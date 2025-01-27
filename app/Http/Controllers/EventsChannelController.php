<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Events;
use Illuminate\Http\Request;

class EventsChannelController extends Controller
{
    public function index($id) {

        $event = Events::where( 'event_id', $id)->first();
        return view('user.channel.view')->with([
            'event'=> $event,
            'announcements'=> Announcements::where('channel_id', $event->channel_id)->orderBy('created_at', 'desc')->get()
        ]);
    }
}
