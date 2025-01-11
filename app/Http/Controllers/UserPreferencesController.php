<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use App\Models\UserPreferences;
use App\Models\Users;
use App\Models\UsersLogin;
use Illuminate\Http\Request;

class UserPreferencesController extends Controller
{
    public function index() {
        $user = UsersLogin::where('email', session('email'))->first();

        return view('register.preferences')->with([
            'categories'=> EventCategories::where('parent_id', NULL)->get(),
            'uid'=> $user->user-> user_id
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'preferences'=> 'array' ,
            'preferences.*'=> 'string'
        ]);

        $preferences = $request->input('preferences',[]);

        UserPreferences::create([
            'user_id'=> $request->user_id,
            'preferences'=> json_encode($preferences)
        ]);

        return redirect()->route('auth.location');
    }
}
