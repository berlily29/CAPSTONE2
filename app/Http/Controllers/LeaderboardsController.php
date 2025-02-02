<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardsController extends Controller
{

    public function index() {
        return view('user.leaderboards.view')->with([
            'user'=> Users::where('user_id' ,Auth::user()-> user_id)->first(),
            'top10'=> Users::orderBy('profile_points', 'desc')->take(30)->get(),
            'top30'=> Users::orderBy('profile_points', 'desc')->take(30)->get()
        ]);
    }
}
