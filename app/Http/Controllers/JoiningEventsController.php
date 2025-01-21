<?php

namespace App\Http\Controllers;

use App\Models\UserJoinedEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoiningEventsController extends Controller
{
    public function join_event($id) {
        UserJoinedEvents::create([
            'user_id'=> Auth::user()-> user_id,
            'event_id'=> $id
        ]);

        dd('created');
    }
}
