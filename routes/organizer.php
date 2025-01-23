<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FindEventsController;
use App\Http\Controllers\GalleryController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['organizer'])->group(function() {

    //eo dashboard
    Route::get('/portal/dashboard', function() {
        return view('organizer.dashboard');
    })->name('eo.dashboard');

    //Requesting event
    Route::get('/portal/request/event', [EventOrganizerController::class, 'request_event_index'])->name('eo.request-event');

    Route::post('/portal/request/event', [EventOrganizerController::class, 'submit_request_event'])->name('eo.request-event.store');



});



