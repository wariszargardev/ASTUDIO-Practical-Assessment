<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function (){
    Route::prefix('auth')->name('auth.')->group(function (){
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');

        Route::middleware('auth:api')->group(function (){
            Route::get('user', 'profile')->name('profile');
            Route::post('logout', 'logout')->name('logout');
        });
    });
});


