<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function index()
    {
        return redirect()->route('user.settings.account')->with([
            'user'=> Users::where('user_id', Auth::user()->user_id)->first()]);
    }

    public function account() {

        return view('user.settings.account')->with([
            'user'=> Users::where('user_id', Auth::user()->user_id)->first()]);
    }

    public function userInfo() {

        return view('user.settings.userInfo')->with([
            'user'=> Users::where('user_id', Auth::user()->user_id)->first()]);
    }

    public function storeinfo(Request $request)
{
    $user= Users::where('user_id', Auth::user()->user_id)->first();

    $request->validate([
        'fname'=> 'required|string',
        'mname'=> 'required|string',
        'lname'=> 'required|string',
        'age'=> 'required|string',
        'gender'=> 'required|string',
        'house_no' => 'required|string',
        'street' => 'required|string',
        'brgy' => 'required|string',
        'city' => 'required|string',
        'province' => 'required|string',
        'postal_code' => 'required|string',

    ]);

    
    $user->fname = $request->input('fname');
    $user->mname = $request->input('mname');
    $user->lname = $request->input('lname');
    $user->age = $request->input('age');
    $user->gender = $request->input('gender');
    $user->house_no = $request->input('house_no');
    $user->street = $request->input('street');
    $user->brgy = $request->input('brgy');
    $user->city = $request->input('city');
    $user->province = $request->input('province');
    $user->postal_code = $request->input('postal_code');



    $user->save();


    return redirect()->route('user.settings.userInfo')->with([
        'msg' => 'edited successfully!',]);
}

public function storeaccount(Request $request)
{

    return redirect()->route('user.settings.account')->with([
        'msg' => 'edited successfully!']);
}

}
