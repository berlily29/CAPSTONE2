<?php

namespace App\Http\Controllers;

use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoriesController extends Controller
{
    public function post_story(Request $request) {

        $event = $request->event;
        $path = '/uploads/story/' . $event ;

        if(!Storage::exists($path)){
            Storage::makeDirectory($path);
        }

        $id  = DB::table('stories')->insertGetId ([
            'caption'=> $request->caption,
            'user_id'=> Auth::user()->user_id,
            'channel_id'=>$request->event,
            'created_at'=> now()
        ]);

        $filename = $id  . '-' . $request->file('image')->getClientOriginalName();

        $story = Stories::where('id', $id)->first();
        $story->update([
            'image'=> $filename
        ]);

        $request->file('image')->storeAs($path, $filename,'public');

        session(
            ['newstory'=> true]
        );
        return redirect()-> route('user.channel.index',['id'=> $event]);


    }


    public function delete_story($id){
        $story = Stories::where('id', $id)->first();
        Stories::where('id', $id)->delete();

        //set the session
        session(['story_deleted'=>true]);
        return redirect()->route('user.channel.index',['id'=> $story->channel_id]);
    }
}
