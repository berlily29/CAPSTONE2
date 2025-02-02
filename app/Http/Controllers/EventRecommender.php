<?php

namespace App\Http\Controllers;

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
        dump($user->user_id);

        //get from user preference
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
                        if(!(in_array($event->event_id, $userpreferences_array))) $userpreferences_array[] = $event->event_id;
                    }
                }

            }

        }

        dump($userpreferences_array);



        //get from user_location + event target location
        $user_location = $user->city;
        $baseby_location = Events::where('target_location', $user_location )->get();

        $location_array= [];
        foreach($baseby_location as $item) {
            if(!(in_array($item->event_id, $location_array))) $location_array[] = $item->event_id;
        }

        dump($location_array);


    }
}
