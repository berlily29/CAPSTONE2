<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\AttendanceTokens;
use App\Models\Events;
use App\Models\Stories;
use Illuminate\Http\Request;

class ManageEventsController extends Controller
{
    public function index() {
        return view('admin.manage-events.view')->with([
            'upcoming' => Events::where('status', 'upcoming')->orderBy('title','asc')->get(),
            'done'=>Events::where('status','done')-> orderBy('title', 'asc')->get()


        ]);
    }


    public function view_event($id) {
        $event = Events::where('event_id', $id)->first();
        return view('admin.manage-events.view-event')->with([
            'event'=> $event,
            'announcements'=>  Announcements::where('channel_id', $id)->orderBy('created_at', 'desc')->get(),
            'stories'=> Stories::where('channel_id', $id)->orderBy('created_at' ,'desc')-> get(),
            'users'=>$event->joinedUsers,
            'attendees'=> AttendanceTokens::where('channel_id' , $id)-> where('encoded', 1)->get(),

            'allStories' => Stories::where('channel_id', $id)
                ->with(['user', 'channel'])
                ->get(),
        ]);

    }

}
