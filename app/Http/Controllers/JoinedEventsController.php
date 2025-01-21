<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JoinedEventsController extends Controller
{

    public function index()
    {


        return view('user.joined-events.view')->with([
            'events'=> Auth::user()->user->joinedEvents()->orderBy('date','asc')->get()
        ]);

    }



}
