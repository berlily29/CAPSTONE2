<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindEventsController extends Controller
{
    public function index()
    {
        $open_events = Events::where('date', '>' , today())->get();
        $user_location = Auth::user()->user->city;

        $nearby_events = Events::where('target_location', $user_location)-> get();


        return view('user.find-events.view')->with([
            'open_events'=> $open_events,
            'nearby_events'=> $nearby_events
        ]);
    }

    public function view_event ($id){
        $event = Event::where('event_id', $id)->first();
        dd($event);

    }
}
