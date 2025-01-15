<?php

namespace App\Http\Controllers;

use App\Models\UsersLogin;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index() {

        $users = UsersLogin::where('role', 'User')->get();
        $organizers = UsersLogin::where('role', 'Event Organizer')->get();
        return view('admin.dashboard')->with([
            'users'=> $users->count(),
            'event_organizers'=> $organizers->count()
        ]);


    }
}
