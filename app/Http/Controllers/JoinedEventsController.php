<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JoinedEventsController extends Controller
{

    public function index()
    {

        $all_joined_events = Auth::user()->user->joinedEvents()->orderBy('date','asc')->get();

        $upcoming=[] ;
        foreach($all_joined_events as $event) {
            if($event->status === 'upcoming') {
                array_push($upcoming, $event);
            }
        }


        $done=[] ;
        foreach($all_joined_events as $event) {
            if($event->status === 'done') {
                array_push($done, $event);
            }
        }



        return view('user.joined-events.view')->with([
            'upcoming'=> $upcoming,
            'completed'=> $done
        ]);

    }



}
