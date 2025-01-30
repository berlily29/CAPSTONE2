<?php

namespace App\Http\Controllers;

use App\Models\AttendanceTokens;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()  {


        return view('user.profile.view')->with([
            'user'=> Users::where('user_id', Auth::user()->user_id)->first(),
            'part_events'=> AttendanceTokens::where('user_id',Auth::user()->user_id)
                        ->where('encoded',true)->get()
        ]) ;
    }
}
