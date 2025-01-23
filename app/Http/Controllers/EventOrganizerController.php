<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use Illuminate\Http\Request;

use App\Http\Controllers\EventOrgHelper;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;

class EventOrganizerController extends Controller
{

    protected $func;

    public function __construct()
    {
        $this->func = new EventOrgHelper();
    }


    public function request_event_index() {

        $categories = EventCategories::with('subcategories')->whereNull('parent_id')->get();
        return view('organizer.forms.event', compact('categories'));
    }


    public function submit_request_event(Request $request) {
        $eid = $this->func-> generate_event_id();
        Events::create([
            'event_id'=> $eid,
            'title'=> $request->title,
            'description'=> $request->description,
            'event_category'=> $request->input('child_categories'),
            'event_organizer'=> Auth::user()->user_id,
            'date'=> $request->date,
            'venue'=> $request-> venue,
            'target_location'=> $request->target_location,
            'channel_id'=> null,
            'status'=> 'upcoming',
            'approved'=> 0
        ]);

        return response()->json([
            'response' => 'success',
            'message' => 'Your event request has been successfully submitted!',
        ]);

    }
}
