<?php

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
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function() {


    //joining event
    Route::post('/join_event/{id}',[JoiningEventsController::class, 'join_event'])->name('events.join');


    //leaving event
    Route::delete('/leave_event/{id}', [JoiningEventsController::class, 'leave_event'])->name('events.leave');


    //viewing channels
    Route::get('/event/{id}/channel/',[EventsChannelController::class,'index'])->name('user.channel.index');




});



