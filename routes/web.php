<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ResetPasswordController;






Route::redirect('/','posts');

Route::resource('posts',PostController::class);

Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');


Route::middleware('auth')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//email varification route
Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

//email varification handle route
Route::get('/email/verify/{id}/{hash}', [AuthController::class,'varifyEmail'])->middleware('signed')->name('verification.verify');

//email varification resend route

Route::post('/email/verification-notification', [AuthController::class, 'verifyEmailResend'])->middleware('throttle:6,1')->name('verification.send');

});


Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

     Route::post('/login',[AuthController::class,'login']);
     Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
     Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');
     Route::get('/reset-password/{token}',[ResetPasswordController::class, 'passwordReset'])->name('password.reset');
     Route::post('/reset-password', [ResetPasswordController::class,'passwordUpdate'])->name('password.update');
});

