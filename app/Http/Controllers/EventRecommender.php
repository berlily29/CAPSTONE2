<?php

namespace App\Http\Controllers;

use App\Models\AttendanceTokens;
use App\Models\EventCategories;
use App\Models\Events;
use App\Models\UserPreferences;
use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRecommender extends Controller
{
    public function get_recommended_events() {

        $user = Auth::user()->user;
        $events = Events::all();
        dump('User ID: ' . $user->user_id . ' | ' . $user->fullname);



        //current events (joined = interested)
        $joined_events = $user-> joinedEvents;
        $joined_events_array = [];
        foreach($joined_events as $i) {
                if(!(in_array($i->event_id, $joined_events_array))) $joined_events_array[]= $i->event_id;
        }


        dump('Events currently joined and interested (vvv)');
        dump($joined_events_array);



        //user preferences
        $user_preferences = $user->user_preference;
        $up_array = [];
        foreach(json_decode($user_preferences->preferences) as $item) {
            $category = EventCategories::where('name', $item)->first();
            array_push($up_array,$category->id);
        }

        $userpreferences_array = [];
        foreach($up_array as $item) {
            foreach($events as $event) {
                foreach($event->event_category as $sub) {
                    $category = EventCategories::where('id', $sub)->first();

                     if (in_array($category->parent->id, $up_array) ) {
                        if(!(in_array($event->event_id, $joined_events_array))) {
                            if(!(in_array($event->event_id, $userpreferences_array))) $userpreferences_array[] = $event->event_id;

                        }
                    }
                }
            }
        }

        dump('Events by: User Preferences (vvv)');
        dump($userpreferences_array);

        //user location + event target location
        $user_location = $user->city;
        $baseby_location = Events::where('target_location', $user_location )->get();

        $location_array= [];
        foreach($baseby_location as $item) {
            if(!(in_array($item->event_id, $joined_events_array))) {
                if(!(in_array($item->event_id, $location_array))) $location_array[] = $item->event_id;
            }
        }

        dump('Events by User Location + Event Target Location (vvv)');
        dump($location_array);


        //completed events
        $completed_events_tokens = AttendanceTokens::where('user_id', Auth::user()->user_id)->where('encoded', 1)->get();

        $completed_events_array= [];
        foreach($completed_events_tokens as $token) {

              if(!in_array($token->channel_id, $completed_events_array)) $completed_events_array[] = $token->channel_id;

        }


        $completed_events_categories = [];

        foreach($completed_events_array as $j) {
            $curr = Events::where('event_id', $j)-> first();
            $completed_events_categories[]= $curr->event_category;
        }

        dump('completed events categories: ');
        dump($completed_events_categories);



        dump('Events by Completed Events [with Attendance Tokens] (vvv)');
        dump($completed_events_array);









    }
}
