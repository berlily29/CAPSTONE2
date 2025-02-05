<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardsController extends Controller
{

    public function index() {
        $user = Users::where('user_id', Auth::user()->user_id)->first();
        return view('user.leaderboards.view')->with([
            'user'=> $user,
            'top10'=> Users::whereNot('profile_points', 0)->orderBy('profile_points', 'desc')->take(30)->get(),
            'top30'=> Users::whereNot('profile_points', 0)->orderBy('profile_points', 'desc')->take(30)->get()
        ]);
    }
}
