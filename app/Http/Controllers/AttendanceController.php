<?php

namespace App\Http\Controllers;

use App\Models\AttendanceTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function generate_token_for_user($id) {
        do {
        $token = Str::random(6);
        } while (AttendanceTokens::where('token',$token)->exists());

        AttendanceTokens::create([
            'token'=>$token,
            'user_id'=> Auth::user()->user_id,
            'channel_id' => $id,
            'encoded'=>false
        ]);

        session(['token_generated'=> true ]);
        return redirect()->route('user.channel.index',['id'=> $id]);

    }

    public function encode_token(Request $request, $id) {
        $token = $request->token;
        if(!AttendanceTokens::where('token', $token)->exists()) {
            return response()->json([
                'status'=> 'noexist'
            ]);
        }

        $token_entity = AttendanceTokens::where('token', $token)-> first();
        if($token_entity->encoded == true) {
            return response()->json([
                'status'=> 'existing'
            ]);
        }
        $token_entity->update([
            'encoded'=> true
        ]) ;
        return response()-> json([
            'status'=> 'encoded',
            'user'=> $token_entity->user->fullname
        ]);
    }



}
