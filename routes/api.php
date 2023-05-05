<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ReservationController;

// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);
// Route::get('logout', [AuthController::class, 'logout']);
// Route::get('refresh', [AuthController::class, 'refresh']);
// Route::post('me', [AuthController::class, 'me']);
// Route::group([], function () {
//     Route::apiResource('users', UserController::class);
// });
// Route::group([], function () {
//     Route::apiResource('cars', CarController::class);
// });
// Route::group([], function () {
//     Route::apiResource('reservations', ReservationController::class);
// });
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me'])->middleware('auth');
Route::get('carsInfo', [CarController::class, 'carsInfo']);
Route::patch('activate/{id}', [UserController::class, 'activate']);
Route::patch('desactivate/{id}', [UserController::class, 'desactivate']);
Route::post('reservations', [ReservationController::class, 'store']);
Route::get('datesCar/{id}', [ReservationController::class, 'datesCar']);
// Route::post('me', function () {
//     return Auth::user();
// })->middleware('auth');


Route::get('/images/{image}', function ($image) {
    return response()->file(public_path('storage/images/' . $image));
});

Route::group(['middleware' => ['auth']], function () {
    Route::apiResource('reservations', ReservationController::class)->only(['store']);
    Route::apiResource('users', UserController::class)->only(['index']);
    Route::apiResource('cars', CarController::class)->only(['index']);
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('cars', CarController::class);
    Route::apiResource('reservations', ReservationController::class)->except(['store']);
});
