<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EOPendingsController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FindEventsController;
use App\Http\Controllers\GalleryController;
use App\Models\AttendanceTokens;
use App\Models\EONotifications;
use App\Models\Events;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware(['organizer'])->group(function() {

    //eo dashboard
    Route::get('/portal/dashboard', function() {

        return view('organizer.dashboard')->with([
            'upcomingEvents' => Events::where('date', '>', now())->count(), // Upcoming Eventss count
            'totalAccomplishedEvents' => Events::where('approved', 1)->count(), // Total approved (accomplished) events
            'currentPendingRequests' => Events::where('approved', 0)->count(), // Pending requests count
            'notifications'=> EONotifications::where('user_id', Auth::user()->user_id)-> get()
        ]);
    })->name('eo.dashboard');

    /**
     *
     *
     *
     *
     *
     */
    //Pending Requests Page
    Route::get('/portal/pending-requests',[EOPendingsController::class, 'index'])->name('eo.pending-requests');
    Route::get('/portal/pending-requests/event/{id}', [EventOrganizerController::class, 'view_event_index'])->name('eo.pending-requests.view-event');
    Route::delete('portal/pending-requests/event/{id}', [EventOrganizerController::class, 'hard_delete_termination'])->name('eo.pending-requests.hard-delete');


    /**
     *
     *
     *
     *
     *
     */
    //Forms - Requesting event
    Route::get('/portal/request/event', [EventOrganizerController::class, 'request_event_index'])->name('eo.request-event');
    Route::post('/portal/request/event', [EventOrganizerController::class, 'submit_request_event'])->name('eo.request-event.store');

    /**
     *
     *
     *
     *
     *
     */
    //Channels
    Route::get('/portal/channels', [EventOrganizerController::class, 'channels_index'])->name('eo.channels') ;
    Route::get('portal/channels/{id}' ,[EventOrganizerController::class, 'view_channel'])->name('eo.channels.view');

    Route::get('portal/users/{id}',[EventOrganizerController::class, 'view_user'])->name('eo.channels.view-user');

    Route::post('portal/channels/{id}/mark',[EventOrganizerController::class, 'mark_event_done'])->name('eo.channels.done');
    /*****
     *
     *
     *
     *
     *
     *
     */
    //Posts/Announcements
    //from channel
    Route::get('/portal/channels/{id}/create/post',[EventOrganizerController::class, 'create_post_index'])->name('eo.channels.post.view');
    Route::get('/portal/edit/post/{postid}',[EventOrganizerController::class, 'create_post_editindex'])->name('eo.channels.post.edit');

    Route::post('/portal/channels/{id}/create/post', [EventOrganizerController::class,'publish_post'])->name('eo.channel.post.publish');
    Route::post('/portal/channels/{id}/edit/post', [AnnouncementsController::class,'edit_announcement'])->name('eo.channel.post.edit');

    Route::delete('/delete/{id}',[AnnouncementsController::class,'delete_announcement'] )->name('eo.channel.post.delete');



    /*****
     *
     *
     * ATTENDANCE
     */

     Route::post('portal/channels/{id}/attendance/encode', [AttendanceController::class, 'encode_token'])->name('eo.channel.token.encode');


});



