<?php

use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {

    if(auth('api')->check()) {
        return redirect()->route('user.dashboard');
    }

    $msg = '';
    if(session('errorMessage')) {
        $msg = session('errorMessage');
    }
    return view('login')->with([
        'msg'=> $msg
    ]);



})->name('login');



require __DIR__. '/auths.php';
require __DIR__ .'/logged_user.php';
require __DIR__.'/admin.php';


require __DIR__. '/events.php';
require __DIR__.'/channel.php';
require __DIR__.'/organizer.php';
