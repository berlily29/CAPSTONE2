<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class HelperMethods extends Controller
{
    public function delete_existing_files($id, $cid) {
        $media_path = 'uploads/posts/' . $cid. '/'. $id;
        dd($media_path);

        if(Storage::disk('public')->exists($media_path)){
            Storage::disk('public')->deleteDirectory($media_path);
        }
    }
}
