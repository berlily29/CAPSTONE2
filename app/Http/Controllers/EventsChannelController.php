<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Events;
use App\Models\Stories;
use Illuminate\Http\Request;

class EventsChannelController extends Controller
{
    public function index($id) {

        $event = Events::where( 'event_id', $id)->first();

        if(session('newstory')) {
            $newstory = true;
            session()->forget('newstory');
        } else {
            $newstory = false;
        }

        return view('user.channel.view')->with([
            'event'=> $event,
            'announcements'=> Announcements::where('channel_id', $event->channel_id)->orderBy('created_at', 'desc')->get(),
            'stories'=> Stories::where('channel_id', $id)->get(),
            'newstory'=> $newstory
        ]);
    }
}
