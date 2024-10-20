<?php

use App\Http\Controllers\Api\Auth\{AuthController, LogOutController, RegisterController};
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/logout', [LogOutController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('/orders')->controller(OrderController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::post('/delete', 'delete');
});
