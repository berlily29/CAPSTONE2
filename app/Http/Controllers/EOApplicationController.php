<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EO_Application;
use Illuminate\Support\Facades\Auth;

class EOApplicationController extends Controller
{
    public function index() {
        return view('user.eo_application.view');
}

public function store(Request $request)
    {
        $request->validate([
            'attachment' => 'required|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('attachment')) {

            if($user->user->eo_id && $user->user->eo_id->rejection_count >= 3) {
                return redirect()->back()->with(['msg'=> 'Rejection Exceeded.']);
            }

            $file = $request->file('attachment');

            $userApplication = EO_Application::where('user_id', $user->user_id)->first();

            $filename = $user->user_id . '.' . $file->getClientOriginalExtension();

            $path = 'uploads/application/';

            $file->storeAs($path, $filename, 'public');

                EO_Application::updateOrCreate(
                    ['user_id' => $user->user_id],
                    ['attachment' => $filename,
                    'status' => "Pending"],
                );


            session([
                'eo_ban' => $user->user->eo_id && $user->user->eo_id->rejection_count >= 3 ? true : false
            ]);

            return redirect()->back()->with(['msg'=> 'Success!']);
        }
    }

}
