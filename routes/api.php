<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function (){
    Route::prefix('auth')->name('auth.')->group(function (){
        Route::post('register', 'register')->name('register');
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
