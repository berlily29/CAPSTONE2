<?php

namespace App\Http\Controllers;

use App\Models\EventChannels;
use App\Models\Events;
use App\Models\EventTerminations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPendingsController extends Controller
{
    public function approve_event($id) {


        $event = Events::where('event_id',$id)->first();
        $event->update([
            'approved'=>1
        ]);

        //create the channel
        EventChannels::create([
            'channel_id'=>$id,
            'event_id'=> $id
        ]);

        $event->update([
            'channel_id'=> $id
        ]);

        return response()->json([
            'success'=> true
        ]);

    }

    public function reject_event(Request $request, $id){
        return response()->json([
            'success'=> true
        ]);
        $event = Events::where('event_id' , $id)-> first();
        $event-> update([
            'approved'=>2
        ]);

        $term_id = DB::table('event_terminations')->insertGetId([
            'event_id'=> $event->event_id,
            'reason'=> $request->reason
        ]);

        $event->update([
            'termination_id'=> $term_id
        ]);





    }
}
