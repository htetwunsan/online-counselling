<?php

use App\Http\Controllers\Api\ClientBookingController;
use App\Http\Controllers\Api\CounsellorBookingController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisteredClientController;
use App\Http\Controllers\Api\RegisteredCounsellorController;
use App\Http\Controllers\Api\QuestionController;
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

Route::post('/login', LoginController::class)->name('api.login');

Route::post('/clients/register', RegisteredClientController::class)->name('api.clients.register');

Route::post('/counsellors/register', RegisteredCounsellorController::class)->name('api.counsellors.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user()->detail->load('questions', 'specialities', 'services', 'preferLanguages');
    })->middleware('role:client,counsellor');

    Route::get('/clients/bookings', ClientBookingController::class)
        ->middleware('role:client')
        ->name('api.clients.bookings');

    Route::get('/counsellors/bookings', CounsellorBookingController::class)
        ->middleware('role:counsellor')
        ->name('api.counsellors.bookings');
});

Route::apiResource('questions', QuestionController::class);
