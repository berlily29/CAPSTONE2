<?php

namespace App\Http\Controllers;

use App\Models\RegistrationTokens;
use App\Models\Users;
use App\Models\UsersLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


use App\Mail\RegisterMail;

class LocationController extends Controller
{
    public function index() {
        return view('register.address');
    }


    //email verification sender
    protected function sendEmailToken($email) {

        $RegistrationController = new RegisterController();



        $user = UsersLogin::where('email', $email)-> first();

        $token = $RegistrationController-> generateRegistrationToken();
        if(RegistrationTokens::where('email',$email)->exists()) {
            $RegistrationController-> delete_existing($user->user_id);
        }
        RegistrationTokens::insert([

            'token'=> $token,
            'email'=> $email,
            'created_at'=> now()
        ]);

        $url = url('/verify-email?token=' . $token);
        Mail::to($email)->send(new RegisterMail($url));
        return $token;
    }



    public function store(Request $request) {
        $request->validate ([
            'house_no'=> 'string',
            'street'=> 'string',
            'brgy'=> 'string' ,
            'city'=>'string',
            'postal_code'=> 'string',
            'province'=> 'string'
        ]);



        $user_details = UsersLogin::where('email', session('email'))->first();


        $user = Users::find($user_details->user_id);

        $user->update([
            'house_no'=> $request->house_no,
            'street'=> $request-> street,
            'brgy'=> $request->brgy,
            'city'=> $request->city,
            'postal_code'=> $request->postal_code ,
            'province'=> $request->province
        ]);

        $user->save();

        $email = session('email');
        if($user_details->user-> email_verified ==1) {
            Auth::login($user_details);
            return redirect()-> route('user.dashboard');
        }


        $token = $this-> sendEmailToken($email);
        return redirect()->route('auth.register.success',['token'=> $token]);






    }
}
