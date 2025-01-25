<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPendingsController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\ManageEventsController;
use App\Http\Controllers\PendingRequestController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['admin'])-> group(function() {


    //User dashboard
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    //Admin Settings
    Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');

    //Manage Events
    Route::get('/admin/manage-events', [ManageEventsController::class, 'index'])->name('admin.manage-events');

    //Pending Request
    Route::get('/admin/pending-request', [PendingRequestController::class, 'index'])->name('admin.pending-request');
    Route::put('/admin/pending-request/approveStatus/{userId}', [PendingRequestController::class, 'approveStatus'])->name('admin.pending-request.approveStatus');
    Route::put('/admin/pending-request/rejectStatus/{userId}', [PendingRequestController::class, 'rejectStatus'])->name('admin.pending-request.rejectStatus');

    Route::get('/admin/pending-request/event/{id}', [PendingRequestController::class, 'view_event'])->name('admin.pending-request.view-event');
    Route::get('/admin/pending-request/event/{id}/termination', [PendingRequestController::class,'view_termination'])->name('admin.pending-request.view-termination');

    Route::post('/admin/pending-request/event/{id}/approve',[AdminPendingsController::class, 'approve_event'])->name('admin.pending-request.approve-event');

    Route::post('/admin/pending-request/event/{id}/reject',[AdminPendingsController::class, 'reject_event'])->name('admin.pending-request.reject-event');



    //User Management
    Route::get('/admin/user-management', [UserManagementController::class, 'index'])->name('admin.user-management');
});



