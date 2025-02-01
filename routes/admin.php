<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPendingsController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\GalleryController;
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


    //Manage user and event organanizer application
    Route::get('/admin/pending-request', [PendingRequestController::class, 'index'])->name('admin.pending-request.application');
    Route::put('/admin/pending-request/approveStatus/{userId}', [PendingRequestController::class, 'approveStatus'])->name('admin.pending-request.application.approveStatus');
    Route::put('/admin/pending-request/rejectStatus/{userId}', [PendingRequestController::class, 'rejectStatus'])->name('admin.pending-request.application.rejectStatus');
    Route::put('/admin/pending-request/updateApplication/{userId2}', [PendingRequestController::class, 'updateApplication'])->name('admin.pending-request.application.updateApplication');

   

    //Manage Events
    Route::get('/admin/pending-request/event/', [PendingRequestController::class, 'index_event'])->name('admin.pending-request.event');
    Route::get('/admin/pending-request/event/{id}', [PendingRequestController::class, 'view_event'])->name('admin.pending-request.event.view-event');
    Route::get('/admin/pending-request/event/{id}/termination', [PendingRequestController::class,'view_termination'])->name('admin.pending-request.event.view-termination');
    Route::post('/admin/pending-request/event/{id}/approve',[AdminPendingsController::class, 'approve_event'])->name('admin.pending-request.event.approve-event');
    Route::post('/admin/pending-request/event/{id}/reject',[AdminPendingsController::class, 'reject_event'])->name('admin.pending-request.event.reject-event');



    //User Management
    Route::get('/admin/user-management', [UserManagementController::class, 'index'])->name('admin.user-management');
    Route::get('/admin/user-management/filter', [UserManagementController::class, 'filter'])->name('admin.user-management.filter');


    //Gallery
    Route::get('/admin/gallery',[GalleryController::class,'admin_index'])->name('admin.gallery'); 
});



