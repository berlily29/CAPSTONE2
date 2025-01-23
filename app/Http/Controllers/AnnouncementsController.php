<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementsReaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementsController extends Controller
{
    public function like_announcement($event, $post) {


        if(AnnouncementsReaders::where('post_id', $post)->where('user_id', Auth::user()->user_id)->exists()) {

            $totalReaders = AnnouncementsReaders::where('post_id', $post)->count();

            return response()->json([
                'success' => true,
                'message' => 'Liked successfully',
                'totalReaders' => $totalReaders,
            ]);
        }
        AnnouncementsReaders::create([
            'post_id' => $post,
            'user_id' => Auth::user()->user_id,
        ]);

        $totalReaders = AnnouncementsReaders::where('post_id', $post)->count();

        return response()->json([
            'success' => true,
            'message' => 'Liked successfully',
            'totalReaders' => $totalReaders,
        ]);

    }

    public function dislike_announcement($event, $post) {

        $liker = AnnouncementsReaders::where('post_id', $post)->where('user_id', Auth::user()->user_id)->first();

        $liker->delete();

        $totalReaders = AnnouncementsReaders::where('post_id', $post)->count();

        return response()->json([
            'success' => true,
            'message' => 'Disliked successfully',
            'totalReaders' => $totalReaders,
        ]);
    }
}
