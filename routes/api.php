<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

Route::post('signin', [AuthController::class, 'signIn']);
Route::post('signup', [AuthController::class, 'signUp']);

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('test', [AuthController::class, 'test']);

    Route::get('categories', [CategoryController::class, 'getAll']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::post('categories/create', [CategoryController::class, 'create']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'delete']);

    Route::get('products', [ProductController::class, 'getAll']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('products/create', [ProductController::class, 'create']);
    Route::delete('products/{id}', [ProductController::class, 'delete']);
    Route::post('products/{id}', [ProductController::class, 'update']);
});

