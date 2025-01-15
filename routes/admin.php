<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;




Route::middleware(['admin'])-> group(function() {

    //User dashboard
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');








});



