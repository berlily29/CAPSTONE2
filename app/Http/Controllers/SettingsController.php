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

    public function storeinfo(Request $request, $id)
{
    $request->validate([
        // 'name' => 'required|string|max:255',
    ]);

   
    $user= Users::where('user_id', Auth::user()->user_id)->first();
    $user->name = $request->input('name');
    $user->save();

    return redirect()->route('user.settings.account')->with(['msg' => 'edited successfully!']);
}

public function storeaccount(Request $request, $id)
{
    $request->validate([
        // 'name' => 'required|string|max:255',
    ]);

   
    $user= Users::where('user_id', Auth::user()->user_id)->first();
    $user->name = $request->input('name');
    $user->save();

    return redirect()->route('user.settings.account')->with(['msg' => 'edited successfully!']);
}

}
