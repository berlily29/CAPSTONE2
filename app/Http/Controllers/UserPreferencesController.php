<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use App\Models\ID;
use App\Models\UserPreferences;
use App\Models\Users;
use App\Models\UsersLogin;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserPreferencesController extends Controller
{

    protected function delete_existing($id) {

        UserPreferences::where('user_id' ,$id)->delete();

    }
    public function index() {
        $user = UsersLogin::where('email', session('email'))->first();

        return view('register.preferences')->with([
            'categories'=> EventCategories::where('parent_id', NULL)->get(),
            'uid'=> $user->user-> user_id
        ]);
    }

    public function store(Request $request) {
        $this->delete_existing($request->user_id);
        $request->validate([
            'preferences'=> 'array' ,
            'preferences.*'=> 'string'
        ]);

        $preferences = $request->input('preferences',[]);

        UserPreferences::create([
            'user_id'=> $request->user_id,
            'preferences'=> json_encode($preferences)
        ]);


        $user= UsersLogin::where('user_id', $request->user_id)->first();

        //check if the location is already set
        if($user->user->province == null || $user->user->house_no == null || $user->user->street == null || $user->user->brgy == null || $user->user->city == null || $user-> user-> postal_code == null) {
            return redirect()->route('auth.location');
        }

        //check if an ID is already uploaded.
        if(!(ID::where('user_id', $user->user_id)->exists())){
            return redirect()-> route('auth.id')->with(['email', session('email')]);
        }

        session([
            'is_approved'=> $user->user->account_status === 'Pending' ? false : true
        ]);


        FacadesAuth::login($user);
        return redirect()->route('user.dashboard');
    }
}
