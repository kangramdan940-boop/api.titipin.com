<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;

// Public
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index']);
Route::apiResource('events', EventController::class)->only(['index', 'show']);

// Authenticated
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'update']);
    Route::get('/user/addresses', [UserController::class, 'addresses']);
    Route::post('/user/addresses', [UserController::class, 'storeAddress']);

    Route::apiResource('cart', CartController::class)->except(['show']);
    Route::apiResource('orders', OrderController::class)->only(['index', 'show', 'store']);
});
