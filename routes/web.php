<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::controller(MainController::class)->name('main.')->group(function () {
    Route::get('/','home')->name('home');
});

Route::controller(AuthController::class)->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/login','login')->name('login');
        Route::get('/register','register')->name('register');
        Route::get('/password','password')->name('password');
    });

    Route::post('/login','_loginPOST');
    Route::post('/register','_registerPOST');
    Route::post('/password','_passwordPOST');
});

Route::controller(UserController::class)->prefix('/user')->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/panel','panel')->name('panel');
    });
});
