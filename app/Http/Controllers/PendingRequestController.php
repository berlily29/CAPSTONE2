<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use App\Models\ID;


class PendingRequestController extends Controller
{
    public function index()
    {

        $users = Users::where('account_status', "Pending")
        ->where('email_verified', 1)->with(['login','id'])->get();
        $events = Events::where('approved', 0)->get();

        return view('admin.pending-request.view')->with([
            'users' => $users,
            'events'=> $events
        ]);
    }

    public function updateStatus(Request $request, $id) {

        $validatedData = $request->validate([
            'approveButton' => 'required|in:Approved,To-Review',
        ]);

        $user = Users::where('user_id', $id)->first();
        $user_ID = ID::where('user_id', $id)->first();
        $user->update(['account_status' => $request->approveButton]);
        $user_ID->update(['status' => $request->approveButton]);

        return redirect()->route('admin.pending-request')->with(['msg'=> 'Success!']);

    }


    public function view_event($id) {
        return view('admin.pending-request.view-event')->with([
            'event'=> Events::where('event_id', $id)->first()
        ]);

    }
}
