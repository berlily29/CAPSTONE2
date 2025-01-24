<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EOPendingsController extends Controller
{
    public function index() {
        return view('organizer.pending-requests.view')-> with([
            'pendings'=> Events::where('event_organizer',Auth::user()->user_id)
            ->where('approved',0)
            ->get(),
            'terminated'=> Events::where('event_organizer',Auth::user()->user_id)
            ->where('approved',2)
            ->get(),

        ]);


    }
}
