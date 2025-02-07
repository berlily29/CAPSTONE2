<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventsChannelController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FindEventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JoiningEventsController;
use App\Http\Controllers\StoriesController;
use App\Models\Events;
use App\Models\Stories;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function() {

    //Liking announcement
    Route::post('/event/{id}/channel/{post}',[AnnouncementsController::class, 'like_announcement'])->name('announcement.like');
    Route::delete('/event/{id}/channel/{post}', [AnnouncementsController::class, 'dislike_announcement'] )-> name('announcement.dislike');


    ///STORIES

    Route::get('/event/{id}/create/story', function($id) {

    return view('user.forms.stories')->with([
        'event'=> Events::where('event_id' , $id)-> first(),


    ]);
    })->name('user.channel.stories');

    Route::post('event/story/post',[StoriesController::class, 'post_story'])->name('user.channel.stories.post');
    Route::delete('event/story/post/{id}', [StoriesController::class, 'delete_story'])->name('user.channel.stories.delete');


    /***
     *
     *
     *
     *
     * ATTENDANCE
     */

     Route::post('event/{id}/attendance',[AttendanceController::class, 'generate_token_for_user'])->name('user.channel.attendance.post');


});



