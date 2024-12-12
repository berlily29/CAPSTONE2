<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
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

}); 



