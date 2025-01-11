<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index() {
        return view('register.address');
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

        $uid = session('email');

        $user = Users::find($uid);

        $user->upate([
            'house_no'=> $request->house_no,
            'street'=> $request-> street,
            'brgy'=> $request->brgy,
            'city'=> $request->city,
            'postal_code'=> $request->postal_code ,
            'province'=> $request->province
        ]);

        $user->save();








    }
}
