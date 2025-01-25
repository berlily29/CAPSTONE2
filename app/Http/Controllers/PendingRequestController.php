<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use App\Models\ID;
use App\Models\UsersLogin;
use Illuminate\Support\Facades\Mail;
use App\Mail\rejectionNotice;
use App\Mail\deletionNotice;

class PendingRequestController extends Controller
{

    /*****
     *
     *
     *
     *
     * VIEWS
     *
     */
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

    public function view_termination($id) {
        return view('admin.pending-request.termination')->with([
            'event'=> Events::where('event_id' , $id)->first()
        ]);
    }

    /***
     *
     *
     *
     *
     *
     * METHODS
     */

    public function updateStatus(Request $request, $id) {

        $validatedData = $request->validate([
            'approveButton' => 'required',
        ]);


        $user = Users::where('user_id', $id)->first();
        $user_ID = ID::where('user_id', $id)->first();

        if($user && $user_ID) {

        $user->update(['account_status' => $request->approveButton]);
        $user_ID->update(['status' => $request->approveButton]);

        return redirect()->route('admin.pending-request')->with(['msg'=> 'Success!']);
        }

    }

    public function rejectStatus(Request $request, $id) {

        $validatedData = $request->validate([
            "rejectionReason" => 'required'
        ]);

        $user = Users::where('user_id', $id)->first();
        $user_ID = ID::where('user_id', $id)->first();
        $user_Login = UsersLogin::where('user_id', $id)->first();

        if ($user && $user_ID) {

        $user->increment('rejection_count');

        if ($user->rejection_count >= 3) {

            Mail::to($user_Login->email)->send(new deletionNotice($user));
            $user->forceDelete();
            $user_ID->forceDelete();
            $user_Login->forceDelete();

            return redirect()->route('admin.pending-request')->with(['msg'=> 'Success!']);

        }

        if ($validatedData['rejectionReason'] == 'other') {
        Mail::to($user_Login->email)->send(new rejectionNotice($user, $request->otherReason));
        }
        else {
        Mail::to($user_Login->email)->send(new rejectionNotice($user, $validatedData['rejectionReason']));
        }

        $user->update(['account_status' => 'To-Review']);
        $user_ID->update(['status' => 'To-Review']);

        return redirect()->route('admin.pending-request')->with(['msg'=> 'Success!']);

        }

    }


    public function view_event($id) {
        return view('admin.pending-request.view-event')->with([
            'event'=> Events::where('event_id', $id)->first()
        ]);

    }
}
