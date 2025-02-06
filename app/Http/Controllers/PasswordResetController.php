<?php

namespace App\Http\Controllers;

use App\Mail\TokenMail;
use App\Models\PasswordResetTokens;
use App\Models\UsersLogin;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{


    //generate id
    protected function generateId() {
        do {
            $id = Str::random(10);
        } while (PasswordResetTokens::where('id', $id)->exists());

        return $id;
    }


    //generate token for session
    protected function generatePasswordResetToken($email) {
        do {
            $token = Str::random(64);
        } while (PasswordResetTokens::where('token', $token)->exists());

        if(PasswordResetTokens::where('email' , $email)->exists())
        {
            PasswordResetTokens::where('email' , $email)->delete();
        }


        PasswordResetTokens::insert([
            'email'=> $email,
            'token'=> $token,
            'created_at'=> now()
        ]);

        return $token;
    }


    //sending emmail for the reset link
    public function sendResetLink(Request $request) {
        $email = $request->email;


        if(!UsersLogin::where('email', $email)->exists()) {
            return redirect()->route('reset-password')->with([
                'msg'=> 'User not found. Please try again.'
            ]);
        }


        $token = $this-> generatePasswordResetToken($email);

        //sending the email
        $url = url('/verify-session?token=' . $token);
        Mail::to($email)->send(new TokenMail($url));

        return redirect()-> route('reset-password.sent');

    }


    //verifying the session + token
    public function verifySession (Request $request){
        $token= $request->query('token');
        if (PasswordResetTokens::where('token', $token)->exists()) {
            $record = PasswordResetTokens::where('token', $token)->first();
        } else {
            return redirect()->route('reset-password.error');
        }




        $createdAt = $record->created_at;


        if($record && $createdAt->diffInMinutes(now()) >= 15) {
            // expired
            return redirect()->route('reset-password');
        } else {
            return redirect()->route('reset-password.reset', ['token'=> $record->token]);
        }
    }

    public function loadReset($token) {
        $msg = '';
        if(session('msg')!= '' ) {
                $msg = session('msg');
        }
        return view('password-reset.reset')->with([
            'message'=>$msg ,
            'token'=> $token
        ]);
    }


    // reset the password
    public function resetPassword(Request $request, $token) {


        // password
        $pw= $request->password;



        $user_token = PasswordResetTokens::where('token',$token)->first();
        $user= UsersLogin::where('email', $user_token->email)->first();


        $user->update([
            'password'=> Hash::make($pw)
        ]);

        PasswordResetTokens::where('token' , $token)->delete();

        return redirect()-> route('reset-password.success');







    }
}
