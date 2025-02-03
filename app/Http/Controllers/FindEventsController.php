<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class FindEventsController extends Controller
{


    protected $recommender;


    public function __construct()
    {
        $this->recommender = new EventRecommender();

    }

    public function index()
    {
        $open_events = Events::where('date', '>', today())
        ->where('approved', 1)
        // ->where('event_organizer', '!=', Auth::user()->user_id)
        ->whereDoesntHave('joinedUsers', function ($query) {
            $query->where('user_joined_events.user_id', Auth::user()->user_id); // Use the correct table alias
        })
        ->get();


        $user_location = Auth::user()->user->city;

        $nearby_events = Events::where('target_location', $user_location)
        ->where('approved', 1)
        ->whereDoesntHave('joinedUsers', function ($query) {
            $query->where('user_joined_events.user_id', Auth::user()->user_id); // Use the correct table alias
        })
        ->get();


        //recommender
        $recommended_events = $this->recommender->get_recommended_events();


        $rec_event = $recommended_events[rand(0,count($recommended_events)-1)];



        return view('user.find-events.view')->with([
            'open_events'=> $open_events,
            'nearby_events'=> $nearby_events,
            'rec_event'=> Events::where('event_id' , $rec_event)->first()
        ]);
    }

    public function getNewRecommendation()
        {
            // Recommender logic for AJAX
            $recommended_events = $this->recommender->get_recommended_events();

            $rec_event = $recommended_events[rand(0, count($recommended_events) - 1)];

            return response()->json([
                'rec_event' => Events::where('event_id', $rec_event)->first()
            ]);
        }





    public function view_event ($id){
        $event = Events::where('event_id', $id)->first();
        return view('user.find-events.event')->with([
            'event'=> $event
        ]);

    }
}
