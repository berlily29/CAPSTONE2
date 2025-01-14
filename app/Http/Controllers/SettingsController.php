<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings.view')->with([
            'user'=> Users::where('user_id', Auth::user()->user_id)->first()]);
    }


    public function storeinfo(Request $request)
{
    $user= Users::where('user_id', Auth::user()->user_id)->first();

    $request->validate([
        'fname'=> 'string',
        'mname'=> 'string',
        'lname'=> 'string',
        'age'=> 'string',
        'gender'=> 'string',
        'house_no' => 'string',
        'street' => 'string',
        'brgy' => 'string',
        'city' => 'string',
        'province' => 'string',
        'postal_code' => 'string',

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

    return redirect()->route('user.settings')->with([
        'msg' => 'Edited Successfully!']);

}

public function storeaccount(Request $request)
{

    return redirect()->route('user.settings')->with([
        'msg' => 'Edited Successfully!']);
}

}
