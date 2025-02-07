<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\AnnouncementsReaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementsController extends Controller
{

    protected $methods;

    public function __construct()
    {
        $this->methods = new HelperMethods();
    }



     /**
      * 
      *METHODS
      */


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

    public function delete_announcement($id) {

        // Fetch the post
        $post = Announcements::where('post_id', $id)->first();

        // Ensure the post exists
        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        }

        // Get the channel ID
        $channel = $post->channel_id;

        // Delete the post
        $post->delete();

        // Delete related readers
        AnnouncementsReaders::where('post_id', $id)->delete();

        // Build the media path
        $media_path = 'uploads/posts/' . $channel . '/' . $id;

        // Check if the directory exists and delete it
        if (Storage::disk('public')->exists($media_path)) {
            Storage::disk('public')->deleteDirectory($media_path);
        }

        // Return success response
        return response()->json(['success' => true]);
    }



    public function edit_announcement(Request $request, $id) {

        $post = Announcements::where('post_id', $id)-> first();

        if ($request->input('images_changed') == "1") {

            $media_path = 'uploads/posts/' . $post->channel_id . '/' . $id;

            if (Storage::disk('public')->exists($media_path)) {

                Storage::disk('public')->deleteDirectory($media_path);


                $images = [];
                foreach($request->file('images') as $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs($media_path, $filename, 'public');
                    $images[] = $filename; // Add to the images array
                }

                $post->update([
                    'images'=> json_encode($images)
                ]);
            }
        }



        $post->update([
            'title'=> $request->title,
            'content'=>$request->content
        ]);



        return response()->json([
            'success'=> true,

            'channel_id'=> $post->channel_id
        ]);
    }
}
