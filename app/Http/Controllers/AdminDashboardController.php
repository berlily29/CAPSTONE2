<?php

namespace App\Http\Controllers;

use App\Models\EONotifications;
use App\Models\Events;
use App\Models\UsersLogin;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminDashboardController extends Controller
{
    public function index() {

        $users = UsersLogin::where('role', 'User')->get();
        $organizers = UsersLogin::where('role', 'Organizer')->get();
        $notifs = EONotifications::where('user_id', FacadesAuth::user()->user_id)->get();
        $events = Events::all();
        return view('admin.dashboard')->with([
            'users'=> $users->count(),
            'event_organizers'=> $organizers->count(),
            'events'=> $events->count()

        ]);


    }
}
