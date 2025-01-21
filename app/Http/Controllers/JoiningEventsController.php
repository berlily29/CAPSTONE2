<?php

namespace App\Http\Controllers;

use App\Models\UserJoinedEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoiningEventsController extends Controller
{
    public function join_event($id) {
        if(!(UserJoinedEvents::where('event_id', $id)-> where('user_id', Auth::user()->user_id)->exists())) {
            UserJoinedEvents::create([
                'user_id'=> Auth::user()-> user_id,
                'event_id'=> $id
            ]);
        }

        return redirect()->route('user.joinevents')->with('joined',true);
    }
}
