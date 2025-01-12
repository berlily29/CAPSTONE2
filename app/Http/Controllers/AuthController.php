<?php

namespace App\Http\Controllers;

use App\Models\UserPreferences;
use App\Models\Users;
use App\Models\UsersLogin;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{

    protected function isAuthenticated() {
        if (auth('api')->check()) {
            return redirect()->route('user.dashboard');
        }
    }



    public function login(Request $request)
    {
        $this->isAuthenticated();

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Check if the user exists

        if (!(UsersLogin::where('email', $request->email)->exists())) {
            return redirect()->route('login')->with(['errorMessage' => 'User not found. Please check your credentials.']);
        }
        $user = UsersLogin::where('email', $request->email)->first();
        session(['email'=> $user->email, 'id'=> $user->user_id]);

        // Verify the password manually
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with(['errorMessage' => 'Incorrect password. Please try again.']);
        }

        //check if user preference is already set
        if(!(UserPreferences::where('user_id', $user->user_id)->exists())) {
            return redirect()->route('auth.preferences');
        }


        //check if the location is already set
        if($user->user->province == null || $user->user->house_no == null || $user->user->street == null || $user->user->brgy == null || $user->user->city == null || $user-> user-> postal_code == null) {
            return redirect()->route('auth.location');
        }


        // Check email verification status
        if ($user->user->email_verified == 0) {
            return redirect()->route('auth.unverified')->with(['email' => $request->email]);
        }



        // Log in the user
        Auth::login($user);
        return redirect()->route('user.dashboard');
    }




    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }




}
