<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindEventsController extends Controller
{
    public function index()
    {
        $open_events = Events::where('date', '>', today())
        ->where('approved', 1)
        // ->where('event_organizer', '!=', Auth::user()->user_id)
        ->whereDoesntHave('joinedUsers', function ($query) {
            $query->where('user_joined_events.user_id', Auth::user()->user_id); // Use the correct table alias
        })
        ->get();


        $user_location = Auth::user()->user->city;

        $nearby_events = Events::where('target_location', $user_location)
        ->where('approved', 1)
        ->whereDoesntHave('joinedUsers', function ($query) {
            $query->where('user_joined_events.user_id', Auth::user()->user_id); // Use the correct table alias
        })
        ->get();


        return view('user.find-events.view')->with([
            'open_events'=> $open_events,
            'nearby_events'=> $nearby_events
        ]);
    }

    public function view_event ($id){
        $event = Events::where('event_id', $id)->first();
        return view('user.find-events.event')->with([
            'event'=> $event
        ]);

    }
}
