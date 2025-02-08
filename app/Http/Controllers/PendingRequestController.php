<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\EO_Application;
use Illuminate\Support\Facades\Auth;
use App\Models\ID;
use App\Models\UsersLogin;
use Illuminate\Support\Facades\Mail;
use App\Mail\rejectionNotice;
use App\Mail\deletionNotice;
use App\Mail\rejectApplicationNotice;
use App\Mail\banApplicationNotice;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;

class PendingRequestController extends Controller
{


    protected $notif;

    public function __construct()
    {

        $this->notif = new NotificationController();
    }


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

        $application = EO_Application::where('status', "Pending")->get();

        return view('admin.pending-request.view')->with([
            'users' => $users,
            'applications' => $application
        ]);
    }

    public function index_event()
    {
        $events = Events::where('approved', 0)->get();

        return view('admin.pending-request.events')->with([
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

    public function approveStatus(Request $request, $id) {

        $validatedData = $request->validate([
            'approveButton' => 'required',
        ]);


        $user = Users::where('user_id', $id)->first();
        $user_ID = ID::where('user_id', $id)->first();

        if($user && $user_ID) {

        $user->update(['account_status' => $request->approveButton]);
        $user_ID->update(['status' => $request->approveButton]);



        return redirect()->route('admin.pending-request.application')->with(['msg'=> 'Success!']);
        }

    }

    public function updateApplication(Request $request, $id) {
        $validatedData = $request->validate([
            'approveButton2' => 'required',
        ]);

        $user_application = EO_Application::where('user_id', $id)->first();

        if ($request->approveButton2 == 'To-Review') {
            $user_application->increment('rejection_count');

            $user_application->update(['status' => $request->approveButton2]);

            if($user_application->rejection_count >= 3) {
            Mail::to($user_application->user->login->email)->send(new banApplicationNotice($user_application->user));
            }
            else {
            Mail::to($user_application->user->login->email)->send(new rejectApplicationNotice($user_application->user));
            }

            $path = 'uploads/application/';
            if (Storage::disk('public')->exists($path . $user_application->attachment))
                {
                Storage::disk('public')->delete($path . $user_application->attachment);
                }


            return redirect()->route('admin.pending-request.application')->with(['msg'=> 'Success!']);

        }
        else if ($request->approveButton2 == "Approved") {
            $user_application->update(['status' => $request->approveButton2]);
            $user = UsersLogin::where('user_id',$id)->first();
            $user->update([
                'role'=> 'Organizer'
            ]);
            return redirect()->route('admin.pending-request.application')->with(['msg'=> 'Success!']);

        }
    }

    public function rejectStatus(Request $request, $id) {

        $validatedData = $request->validate([
            "rejectionReason" => 'required'
        ]);

        $user = Users::where('user_id', $id)->first();
        $user_ID = ID::where('user_id', $id)->first();
        $user_Login = UsersLogin::where('user_id', $id)->first();

        $pathProfile = 'uploads/profilepic/';
        $pathId = '/uploads/id/';

        if ($user && $user_ID) {

        $user->increment('rejection_count');

        if ($user->rejection_count >= 3) {

    
            Mail::to($user_Login->email)->send(new deletionNotice($user));


            if (Storage::disk('public')->exists($pathProfile . $user->profile_picture)) {
                Storage::disk('public')->delete($pathProfile . $user->profile_picture);
            }

            if (Storage::disk('public')->exists($pathId . $user_ID->attachment)) {
                Storage::disk('public')->delete($pathId . $user_ID->attachment);
            }

            $user->forceDelete();
            $user_ID->forceDelete();
            $user_Login->forceDelete();

            return redirect()->route('admin.pending-request.application')->with(['msg'=> 'Success!']);

        }

        if ($validatedData['rejectionReason'] == 'other') {
        Mail::to($user_Login->email)->send(new rejectionNotice($user, $request->otherReason));
        }
        else {
        Mail::to($user_Login->email)->send(new rejectionNotice($user, $validatedData['rejectionReason']));
        }

        if (Storage::disk('public')->exists($pathId . $user_ID->attachment)) {
            Storage::disk('public')->delete($pathId . $user_ID->attachment);
        }

        $user->update(['account_status' => 'To-Review']);
        $user_ID->update(['status' => 'To-Review']);

        return redirect()->route('admin.pending-request.application')->with(['msg'=> 'Success!']);

        }

    }


    public function view_event($id) {
        return view('admin.pending-request.view-event')->with([
            'event'=> Events::where('event_id', $id)->first()
        ]);

    }
}
