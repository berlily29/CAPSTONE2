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
        // dump('User ID: ' . $user->user_id . ' | ' . $user->fullname);

        $me = Events::where('event_organizer' , $user->user_id)->get();
        $myevents = []; //events that are managed by the user
        foreach($me as $i) {
            $myevents[] = $i->event_id;
        }


        //current events (joined = interested)
        $joined_events = $user-> joinedEvents;
        $joined_events_array = [];
        foreach($joined_events as $i) {
                if(!(in_array($i->event_id, $joined_events_array)) && !(in_array($i->event_id, $myevents))) $joined_events_array[]= $i->event_id;
        }

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
                            if(!(in_array($event->event_id, $userpreferences_array)) && !(in_array($event->event_id, $myevents))) $userpreferences_array[] = $event->event_id;

                        }
                    }
                }
            }
        }
        //user location + event target location
        $user_location = $user->city;
        $baseby_location = Events::where('target_location', $user_location )->get();

        $location_array= [];
        foreach($baseby_location as $item) {
            if(!(in_array($item->event_id, $joined_events_array))) {
                if(!(in_array($item->event_id, $location_array)) && !(in_array($item->event_id, $myevents))) $location_array[] = $item->event_id;
            }
        }
        //event recommendations based on completed events
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

        $category_counts = [];

        foreach ($completed_events_categories as $categories) {
            foreach ($categories as $category) {
                $category_counts[$category] = ($category_counts[$category] ?? 0) + 1;
            }
        }

        arsort($category_counts);

        $top_categories = array_slice(array_keys($category_counts), 0, 3);

        $sugg_events = [];
        foreach($top_categories as $item) {
            foreach($events as $_event) {
                $event_categories =  $_event-> event_category;
                if(!(in_array($event->event_id, $joined_events_array))) {
                    if(in_array($item, $event_categories)) {
                        if(!(in_array($event->event_id, $sugg_events)) && !(in_array($event->event_id, $myevents))) $sugg_events[]= $event->event_id;
                    }
                }
            }
        }

        //event recommendation based on user interest

        $joined_events_categories = [];

        foreach ($joined_events_array as $event_id) {
            $event = Events::where('event_id', $event_id)->first();
            if ($event) {
                $joined_events_categories[] = $event->event_category;
            }
        }

        $category_counts = [];

        foreach ($joined_events_categories as $categories) {
            foreach ((array)$categories as $category) {
                $category_counts[$category] = ($category_counts[$category] ?? 0) + 1;
            }
        }

        arsort($category_counts);

        $top_3_categories = array_slice(array_keys($category_counts), 0, 3);

        $rec_events = [];
        foreach($top_3_categories as $item) {
            foreach($events as $_event) {
                $event_categories =  $_event-> event_category;
                if(!(in_array($_event->event_id, $joined_events_array))) {
                    if(in_array($item, $event_categories)) {
                        if(!(in_array($_event->event_id, $rec_events))) $rec_events[]= $_event->event_id;
                    }
                }
            }
        }


        $all_recommended_events = array_merge(
            $userpreferences_array,
            $location_array,
            $sugg_events,
            $rec_events
        );

        $event_counts = array_count_values($all_recommended_events);
        arsort($event_counts);
        $top_events = array_slice(array_keys($event_counts), 0, intdiv(count($event_counts), 2));


        return $top_events;


    }


}
