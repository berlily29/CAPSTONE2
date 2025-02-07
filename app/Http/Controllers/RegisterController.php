<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\RegistrationTokens;
use App\Models\Users;
use App\Models\UsersLogin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{





    //generate user id
    public function generateId() {
        do{
            $id = (string) rand(20300000, 20430000);
        }while(UsersLogin::where('user_id', $id)->exists());

        return $id;
    }



    //registration token
    public function generateRegistrationToken() {
        do {
            $token = Str::random(64);

        }while(RegistrationTokens::where('token', $token)->exists() );

        return $token;

    }

    public function delete_existing($id) {

        $user = UsersLogin::where('user_id', $id)->first();

        $data = RegistrationTokens::where('email', $user->email)->first();
        $data->delete();



    }


    public function email_verification_checker($email) {
        $user = UsersLogin::where('email',$email)-> first();



        if($user->user->email_verified == 1) {

            return true;
        }

        return false;



    }


    //email verification sender
    protected function sendEmailToken($email) {



        $user = UsersLogin::where('email', $email)-> first();

        $token = $this-> generateRegistrationToken();
        if(RegistrationTokens::where('email',$email)->exists()) {
            $this-> delete_existing($user->user_id);
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

    public function index() {
        $msg = '';
        if(session('msg')!='') {
            $msg=session('msg');
        }
        return view('register')->with([
            'msg'=> $msg
        ]);
    }

    public function register(Request $request) {


        //check if the email already exist
        if(UsersLogin::where('email',$request->email)->exists()) {
            return redirect()-> route('auth.register')-> with([
                'msg'=> 'User already exists.'
            ]);
        }

        //generate ID for the new user
        $uid = $this-> generateId();


        //create the login credentials
        UsersLogin::create([
            'user_id'=> $uid,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role'=> 'User'
        ]);
        Users::insert([
            'user_id'=>$uid,
            'fname'=> $request->fname,
            'mname'=> $request->mname,
            'lname'=> $request->lname,
            'age' => $request->age,
            'gender' => $request->gender,
            'mobile_no' => $request->mobile_no,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        // $token = $this->  sendEmailToken($request->email);
        // return redirect()->route('auth.register.success',['token'=> $token]);



        session(['email'=> $request->email]);
        return redirect()->route('auth.preferences');
    }

    //re-send verification for users
    public function resend_verification($id) {
        $token=  $this->generateRegistrationToken();

        $user = UsersLogin::where('user_id', $id)-> first();

        if(RegistrationTokens::where('email',$user->email)->exists()) {
            $this-> delete_existing($id);
        }
        $token = $this->  sendEmailToken($user->email);


        return redirect()->route('auth.register.success',['token'=> $token]);


    }






    public function success($token) {
        return view('register.created')->with([
            'token'=> $token
        ]);
    }



      //verifying the session + token
      public function verifySession (Request $request){
        $token= $request->query('token');


        $record = RegistrationTokens::where('token', $token)->first();


        $createdAt = $record->created_at;


        if($record && $createdAt->diffInMinutes(now()) >= 60) {
            // expired
            return redirect()->route('register.expired');
        } else {

            $login = UsersLogin::where('email', $record->email)->first();

            $user = Users::where('user_id', $login->user_id)->first();
            $user->email_verified = 1;
            $user->save();
            $this->delete_existing($login->user_id);
            return view('register.verified');
        }
    }
}
