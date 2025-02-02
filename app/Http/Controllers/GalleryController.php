<?php

namespace App\Http\Controllers;

use App\Models\EventChannels;
use App\Models\Gallery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery_channels = Gallery::all();
        $live_channel_ids = $gallery_channels->pluck('channel_id')->toArray();

        // Fetch channels that are part of the gallery (live channels)
        $live_channels = EventChannels::whereIn('channel_id', $live_channel_ids)->paginate(2);

        return view('user.gallery.view')->with([
            'live' => $live_channels
        ]);
    }



    /****
     *
     * ADMIN
     */

     public function admin_index() {
        $gallery_channels = Gallery::all();
        $live_channel_ids = $gallery_channels->pluck('channel_id')->toArray();

        // Fetch channels that are part of the gallery (live channels)
        $live_channels = EventChannels::whereIn('channel_id', $live_channel_ids)->get();

        // Fetch channels that are not part of the gallery (unincluded channels)
        $unincluded_channels = EventChannels::whereNotIn('channel_id', $live_channel_ids)->get();



        return view('admin.gallery.view')->with([
            'live' => $live_channels,
            'not_included' => $unincluded_channels
        ]);

    }

    public function add_to_gallery($id) {

        Gallery::create([
            'channel_id'=> $id
        ]);

       return redirect()-> route('admin.gallery');


    }


    public function remove_from_gallery($id){
        Gallery::where('channel_id', $id)->delete();

       return redirect()-> route('admin.gallery');
    }


}
