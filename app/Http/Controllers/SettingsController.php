<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



class SettingsController extends Controller
{
    public function index()
    {

        $user = Users::where('user_id', Auth::user()->user_id)->first();


        return view('user.settings.view')->with([
            'user'=> $user,

        ]);
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
        'mobile_no'=> 'required|string',
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
    $user->mobile_no = $request->input('mobile_no');

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
        'msg' => 'Edited Successfully!',
        'page' => '2']);

}

public function storeProfilePic(Request $request)
{

    $user= Users::where('user_id', Auth::user()->user_id)->first();

    $request->validate([

        "changeProfileButton" => "required | file | max:2048| mimes:jpeg,png,jpg,gif"
    ]);

    $path = 'uploads/profilepic/';

    if (!Storage::disk('public')->exists($path)) {
        Storage::disk('public')->makeDirectory($path);
    }

    if($request->hasFile('changeProfileButton')) {

    $fileFormat = $user->user_id . '.' . $request->file('changeProfileButton')->getClientOriginalExtension();

    if (Storage::disk('public')->exists($path . $user->profile_picture)) {
        Storage::disk('public')->delete($path . $user->profile_picture);
    }

    $request->file('changeProfileButton')->storeAs($path,$fileFormat, 'public');

    $user->profile_picture = $fileFormat;

    $user->save();

    }

    return redirect()->route('user.settings')->with([
        'msg' => 'Edited Successfully!',
        'page' => '1']);
}

public function deleteProfilePic(Request $request) {

    $user= Users::where('user_id', Auth::user()->user_id)->first();


    $path = 'uploads/profilepic/';

    if (Storage::disk('public')->exists($path . $user->profile_picture)) {
        Storage::disk('public')->delete($path . $user->profile_picture);
    }


    $user->profile_picture = '';
    $user->save();

    return redirect()->route('user.settings')->with([
        'msg' => 'Profile Deleted!',
        'page' => '1']);


}

public function changePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed'
    ]);

    if(!Hash::check($request->current_password, Auth::user()->password)){
        return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
}
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('user.settings')->with([
        'msg' => 'Password Changed!',
        'page' => '3']);



}

}
