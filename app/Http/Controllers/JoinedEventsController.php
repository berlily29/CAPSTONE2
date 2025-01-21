<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JoinedEventsController extends Controller
{
    private function getEvents()
    {
        return [
            ['id' => 1, 'name' => 'General Assembly'],
            ['id' => 2, 'name' => 'Youth Dev Training'],
        ];
    }

    public function index()
    {


        return view('user.joined-events.view')->with([
            'events'=> Auth::user()->user->joinedEvents
        ]);

    }



}
