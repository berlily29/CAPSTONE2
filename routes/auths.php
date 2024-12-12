<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use App\Models\UsersLogin;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

function getSessionMessage() { 
    $msg= ''; 
    if(session('msg') != '') { 
        $msg = session('msg'); 
    } 

    return $msg; 
}



Route::post('/login/verification', [AuthController::class, 'login'])->name('auth.login'); 

//Register
Route::get('signup', [RegisterController::class, 'index'])->name('auth.register'); 
Route::post('register',[RegisterController::class, 'register'])->name('auth.register.save'); 
Route::get('register/success/{token}',[RegisterController::class, 'success'])->name('auth.register.success'); 
Route::get('/verify-email', [RegisterController::class, 'verifySession'])->name('auth.register.verify');
Route::get('/resend-verification/{id}', [RegisterController::class, 'resend_verification'])->name('auth.register.resend'); 

Route::get('/verify-email/expired', function() { 
    return view('register.expired'); 
})->name('auth.register.expired'); 

Route::get('/login/unverified',function() { 
 
    
    $user = UsersLogin::where('email', session('email'))->first(); 
   
    return view('unverified')->with([
        'email'=> $user->email,
        'id'=> $user->user_id
    ]); 
})-> name('auth.unverified'); 

Route::post('logout', [AuthController::class, 'logout'])->name('logout'); 

// Password-Reset
Route::get('/reset-password', function() { 
    $msg = getSessionMessage(); 
    return view('password-reset.form')->with([ 
        'message'=> $msg
    ]); 
})->name('reset-password'); 
Route::post('/reset-password', [PasswordResetController::class, 'sendResetLink'])->name('reset-password.send'); 
Route::get('/reset-password/sent' , function(){ 
    return view('password-reset.sent'); 
})-> name('reset-password.sent'); 
Route::get('/verify-session', [PasswordResetController::class, 'verifySession'])->name('reset-password.verify');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'loadReset'])->name('reset-password.reset'); 
Route::patch('/reset-password/{token}/save', [PasswordResetController::class, 'resetPassword'])-> name('reset-password.save'); 