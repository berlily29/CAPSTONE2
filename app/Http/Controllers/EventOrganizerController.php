<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use Illuminate\Http\Request;

use App\Http\Controllers\EventOrgHelper;
use App\Models\Announcements;
use App\Models\AttendanceTokens;
use App\Models\EventChannels;
use App\Models\Events;
use App\Models\EventTerminations;
use App\Models\Stories;
use App\Models\Users;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Database\Schema\PostgresSchemaState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventOrganizerController extends Controller
{

    protected $func;

    public function __construct()
    {
        $this->func = new EventOrgHelper();
    }



    /***
     *
     *
     *
     VIEWS
     *
     *
     */

    public function request_event_index() {

        $categories = EventCategories::with('subcategories')->whereNull('parent_id')->get();
        return view('organizer.forms.event', compact('categories'));
    }

    public function channels_index() {
        $events = Events::where('approved',1)-> where('status', 'upcoming')->get() ;
        return view('organizer.channels.view')->with([
            'events'=> $events
        ]);
    }

    public function view_event_index($id) {
        return view('organizer.pending-requests.view-event')->with([
            'event'=> Events::where('event_id', $id)->first(),
            'users'=> Events::where()
        ]);
    }

    public function view_channel($id) {
        $event = Events::where('event_id', $id)->first();

        return view('organizer.channels.channel.view')->with([
            'event'=> $event,
            'announcements'=>  Announcements::where('channel_id', $id)->orderBy('created_at', 'desc')->get(),
            'stories'=> Stories::where('channel_id', $id)->orderBy('created_at' ,'desc')-> get(),
            'users'=>$event->joinedUsers,
            'attendees'=> AttendanceTokens::where('channel_id' , $id)-> where('encoded', 1)->get()
        ]);
    }

    public function create_post_index($id) {
        return view('organizer.channels.channel.create.post')->with([
            'event'=> Events::where('event_id', $id)-> first(),
            'editmode'=>false
        ]);
    }

    public function create_post_editindex($postid) {


        $post = Announcements::where('post_id', $postid)->first();
        return view('organizer.channels.channel.create.post')->with([
            'event'=> Events::where('event_id', $post->channel->event_id)-> first(),
            'post'=> $post,
            'editmode'=> true
        ]);
    }

    public function view_user($id) {
        return view('organizer.channels.channel.view-user-details')->with([
            'user'=>Users::where('user_id', $id)-> first()
        ]);

    }

    public function load_edit_post($id) {  
        return view(); 
    }


     /***
     *
     *
     *
     SUBMIT METHODS
     *
     *
     */



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


    public function hard_delete_termination($id) {
        Events::where('event_id', $id)->delete();
        EventTerminations::where('event_id', $id)->delete();

        return response()-> json([
            'success'=>true
        ]);

    }


    /***
     *
     *
     *
     * ANNOUNCEMENTS
     */

    public function publish_post(Request $request, $id) {
        $event = Events::where('event_id', $id)->first() ;

        //generate the post_id
        $post_id = DB::table('announcements')->insertGetId([

            'title'=> $request->title,
            'content'=> $request->content,

            'channel_id'=> $event->channel_id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);


        //create directory for the file upload
        $path_url= 'uploads/posts/' . $event->channel_id . '/' . $post_id ;
        if(!Storage::disk('public')->exists($path_url)) {
            Storage::disk('public')-> makeDirectory($path_url);
        }


        $images = [];
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs($path_url, $filename, 'public');
                $images[] = $filename; // Add to the images array
            };

            Announcements::where('post_id',$post_id)->update([
                'images'=> json_encode($images)
            ]);
        }


        return response()->json([
            'success'=> true,
            'channel_id'=> $event->channel_id
        ]);

    }




}
