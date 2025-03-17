<?php

use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TimeSheetController;
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
    Route::controller(ProjectController::class)->group(function (){
        // Assign and unassign project to current user
        // We can alternatively pass array of users to assign the project
        // But for now we are just assigning the project to the current user
       Route::prefix('projects')->name('projects.')->group(function (){
           Route::post('assign/{project}', 'assign')->name('assign');
           Route::post('unassign/{project}', 'unAssign')->name('unassign');
       });
    });

    Route::apiResource('timesheet', TimeSheetController::class);

    // Attribute Management
    Route::get('/attributes', [AttributeController::class, 'index']);
    Route::post('/attributes', [AttributeController::class, 'store']);
    Route::put('/attributes/{attribute}', [AttributeController::class, 'update']);
});

