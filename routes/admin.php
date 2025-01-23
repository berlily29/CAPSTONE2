<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\ManageEventsController;
use App\Http\Controllers\PendingRequestController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['admin'])-> group(function() {

    //User dashboard
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    //Admin Settings
    Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');

    //Manage Events
    Route::get('/admin/manage-events', [ManageEventsController::class, 'index'])->name('admin.manage-events');

    //Pending Request
    Route::get('/admin/pending-request', [PendingRequestController::class, 'index'])->name('admin.pending-request');
    Route::put('/admin/pending-request/updateStatus/{userId}', [PendingRequestController::class, 'updateStatus'])->name('admin.pending-request.updateStatus');

    Route::get('/admin/pending-request/event/{id}', [PendingRequestController::class, 'view_event'])->name('admin.pending-request.view-event');


    //User Management
    Route::get('/admin/user-management', [UserManagementController::class, 'index'])->name('admin.user-management');
});



