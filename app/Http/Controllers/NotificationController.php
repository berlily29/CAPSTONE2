<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Events;
use App\Models\Notifications;
use App\Models\UserJoinedEvents;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{

    
    

    public function create_post_announcement($id) { 
        $event = Events::where('event_id' ,$id)->first(); 
        $caption = 'A new announcement has been added to ' . $event->title; 

        $joined_users = UserJoinedEvents::where('event_id', $event->event_id)->get(); 

        foreach($joined_users as $item) {
            Notifications::create([
                'caption'=> $caption, 
                'user_id'=> $item->user_id,
                'channel_id'=> $event->event_id
            ]);
        }
    }

    public function delete_announcement($id) { 
         Notifications::where('id', $id)->delete(); 
         return response()->json([
            'success'=>true 
         ]); 
    }
}
