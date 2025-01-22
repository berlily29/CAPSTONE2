<?php

use App\Http\Controllers\AnnouncementsController;
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

    //Liking announcement
    Route::post('/event/{id}/channel/{post}',[AnnouncementsController::class, 'like_announcement'])->name('announcement.like');


    Route::delete('/event/{id}/channel/{post}', [AnnouncementsController::class, 'dislike_announcement'] )-> name('announcement.dislike');



});



