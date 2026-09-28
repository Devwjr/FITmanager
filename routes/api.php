<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register')->name('auth.register');
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:sanctum')->name('auth.logout');
    Route::post('refresh', 'AuthController@refresh')->middleware('auth:sanctum')->name('auth.refresh');
    Route::post('verify/{id}/{hash}', 'AuthController@verify')->name('verification.verify');
    Route::post('resend', 'AuthController@resend')->name('verification.resend');
    Route::post('forgot', 'AuthController@forgot')->name('auth.forgot');
    Route::post('reset', 'AuthController@reset')->name('password.reset');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('me', function (Request $request) {
            return $request->user()->load('profile');
        });
        Route::get('training/exercises', 'TrainingController@exercises');
        Route::post('training/exercises', 'TrainingController@saveExercise');
        Route::put('training/exercises/{exercise}', 'TrainingController@saveExercise');
        Route::get('training/students', 'TrainingController@students');
        Route::get('training/{user}/workouts', 'TrainingController@workouts');
        Route::post('training/{user}/workouts', 'TrainingController@saveWorkout');
        Route::put('training/{user}/workouts/{workout}', 'TrainingController@saveWorkout');
        Route::delete('training/{user}/workouts/{workout}', 'TrainingController@deleteWorkout');
        Route::post('training/{user}/sessions', 'TrainingController@saveSession');
        Route::delete('training/{user}/sessions/{session}', 'TrainingController@deleteSession');
        Route::get('training/{user}/progress', 'TrainingController@progress');
        Route::apiResource('cycles', 'CycleController');
        Route::apiResource('services', 'ServiceController');
        Route::apiResource('branches', 'BranchController');
        Route::apiResource('packages', 'PackageController');
        Route::apiResource('subscriptions', 'SubscriptionController');
        Route::apiResource('users', 'UserController');
        Route::apiResource('users.branches', 'UserBranchController')->except(['show', 'update', 'destroy']);
        Route::apiResource('activities', 'ActivityController');
        Route::get('/stats/subscriptions', 'StatisticsController@subscriptions');
        Route::get('/stats/services', 'StatisticsController@services');
        Route::get('/stats/members', 'StatisticsController@members');
        Route::get('/stats/packages', 'StatisticsController@packages');
        Route::post('/users/{user}/avatar', 'UserAvatarController@store');
    });
});
