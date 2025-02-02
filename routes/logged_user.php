<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\EOApplicationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FindEventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NotificationController;
use App\Models\Gallery;
use App\Models\Notifications;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', function() {

        return view('user.dashboard')->with([
            'is_approved'=> session('is_approved'),
            'is_rejected' => session('is_rejected'),
            'notifications'=> Notifications::where('user_id', Auth::user()->user_id)->get()
        ]);


    })->name('user.dashboard');

    /// PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');




    /// TOP VOLUNTEERS
    Route::get('/leaderboard', [LeaderboardsController::class, 'index'])->name('user.leaderboards');

    /// JOINED EVENTS
    Route::get('/user-joined-events', [JoinedEventsController::class, 'index'])->name('user.joinevents');

    /// SETTINGS
    Route::get('/settings', [SettingsController::class, 'index'])->name('user.settings');
    Route::patch('/settings/userinfo', [SettingsController::class, 'storeInfo'])->name('user.settings.storeUserInfo');
    Route::patch('/settings/userprofilepic', [SettingsController::class, 'storeProfilePic'])->name('user.settings.storeProfilePic');
    Route::patch('/settings/userprofilepic/delete', [SettingsController::class, 'deleteProfilePic'])->name('user.settings.deleteProfilePic');
    Route::post('/settings/changePassword', [SettingsController::class, 'changePassword'])->name('user.settings.changePassword');


    /// FIND EVENTS

    Route::get('/events', [FindEventsController::class, 'index'])->name('find-events.index');
    Route::get('/events/{id}', [FindEventsController::class, 'view_event'])->name('find-events.view');



    /// GALLERY
    Route::get('/user-gallery', [GalleryController::class, 'index'])->name('gallery.index');


    //NOTIFICATIONS

    Route::delete('/notifications/del/{id}',[NotificationController::class,'delete_announcement'])->name('notifications.delete');
    Route::delete('/notifications/del/eo/{id}',[NotificationController::class, 'delete_eoannouncement'])->name('notifications.eodelete');

    // Event Organizer Application
    Route::get('/application', [EOApplicationController::class, 'index'])->name('application.index');
    Route::post('/application', [EOApplicationController::class, 'store'])->name('application.upload');



});



