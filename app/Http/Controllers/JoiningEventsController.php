<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\AnnouncementsReaders;
use App\Models\Events;
use App\Models\UserJoinedEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoiningEventsController extends Controller
{
    public function join_event($id) {
        if(!(UserJoinedEvents::where('event_id', $id)-> where('user_id', Auth::user()->user_id)->exists())) {
            UserJoinedEvents::create([
                'user_id'=> Auth::user()-> user_id,
                'event_id'=> $id
            ]);
        }

        return redirect()->route('user.joinevents')->with('joined',true);
    }

    public function leave_event($id) {
        $event = Events::where('event_id' , $id)->first();


        $posts = Announcements::where('channel_id', $event->channel_id)->get();


        //delete all liked post in the records
        foreach($posts as $post) {
            if(AnnouncementsReaders::where('post_id', $post->post_id)->where('user_id', Auth::user()->user_id)->exists()) {
                $item = AnnouncementsReaders::where('post_id', $post->post_id)->where('user_id', Auth::user()->user_id)->delete();
            }
        }


        //leave the event
        UserJoinedEvents::where('event_id', $id)->where('user_id', Auth::user()->user_id)->delete();

        return redirect()->route('user.joinevents')->with(
            'deleted',true
        );


    }
}
