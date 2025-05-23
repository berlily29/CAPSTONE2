<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\AttendanceTokens;
use App\Models\Events;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsChannelController extends Controller
{
    public function index($id) {

        $event = Events::where( 'event_id', $id)->first();

        if(session('newstory')) {
            $newstory = true;
            session()->forget('newstory');
        } else {
            $newstory = false;
        }


        if(session('story_deleted')) {
            $story_deleted = true;
            session()->forget('story_deleted');
        } else {
            $story_deleted = false;
        }


        if(session('token_generated')) {
            $token_generated = true;
            session()->forget('token_generated');
        } else {
            $token_generated = false;
        }


        if(AttendanceTokens::where('user_id',Auth::user()->user_id)-> where('channel_id', $id)->exists()) {
            $token = AttendanceTokens::where('user_id',Auth::user()->user_id)-> where('channel_id', $id)->first();
        } else {
            $token = null;
        }



        return view('user.channel.view')->with([
            'event'=> $event,
            'announcements'=> Announcements::where('channel_id', $event->channel_id)->orderBy('created_at', 'desc')->get(),
            'myStories' => Stories::where('channel_id', $id)
            ->where('user_id', Auth::user()->user_id)
            ->with(['user', 'channel'])
            ->get(),

            'allStories' => Stories::where('channel_id', $id)
                ->with(['user', 'channel'])
                ->get(),


            'newstory'=> $newstory,
            'story_deleted'=> $story_deleted,
            'token_generated'=> $token_generated,
            'token'=> $token
        ]);
    }
}
