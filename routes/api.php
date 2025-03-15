<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ProjectController;
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

Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);

Route::middleware('auth:api')->group(function (){
    Route::apiResource('projects', ProjectController::class)->except(['index', 'show', 'edit', 'create']);
});

