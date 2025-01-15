<?php
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;




Route::middleware(['admin'])-> group(function() {
    Route::get('/admin', function()  {
        dd('hello');
    })->name('admin.index');








});



