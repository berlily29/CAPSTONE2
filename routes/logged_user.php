<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FindEventsController;
use App\Http\Controllers\GalleryController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', function() {
        return view('user.dashboard');
    })-> name('user.dashboard');

    /// PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');




    /// TOP VOLUNTEERS
    Route::get('/leaderboard', [LeaderboardsController::class, 'index'])->name('user.leaderboards');

    /// JOINED EVENTS
    Route::get('/user-joined-events', [JoinedEventsController::class, 'index'])->name('user.joinevents');
    Route::get('/user-joined-events/{event_id}/announcement', [JoinedEventsController::class, 'announcement'])->name('user.joinevents.announcement');
    Route::get('/user-joined-events/{event_id}/stories', [JoinedEventsController::class, 'stories'])->name('user.joinevents.stories');
    Route::get('/user-joined-events/{event_id}/event-details', [JoinedEventsController::class, 'eventDetails'])->name('user.joinevents.eventdetails');

    /// SETTINGS
    Route::get('/settings', [SettingsController::class, 'index'])->name('user.settings');
    Route::get('/settings/account', [SettingsController::class, 'account'])->name('user.settings.account');
    Route::get('/settings/userinfo', [SettingsController::class, 'userInfo'])->name('user.settings.userInfo');
    Route::patch('/settings/userinfo', [SettingsController::class, 'storeInfo'])->name('user.settings.storeUserInfo');



    /// FIND EVENTS

    Route::get('/user-find-events', function () {
        return view('user.find-events.view');
    })->name('user.find-events');


    /// GALLERY
    Route::get('/user-gallery', function () {
        return redirect()->route('gallery.all'); })->name('gallery.index');

    Route::get('/gallery/all', function () {
        return view('user.gallery.all');})->name('gallery.all');

    Route::get('/gallery/today', function () {
        return view('user.gallery.today'); })->name('gallery.today');

    Route::get('/gallery/this-month', function () {
        return view('user.gallery.thisMonth'); })->name('gallery.thisMonth');

});



