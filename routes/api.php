<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

Route::get('categories', [CategoryController::class, 'getAll']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::post('categories', [CategoryController::class, 'create']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'delete']);

Route::get('products', [ProductController::class, 'getAll']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products', [ProductController::class, 'create']);
Route::delete('products/{id}', [ProductController::class, 'delete']);
Route::post('products/{id}', [ProductController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('signin', [AuthController::class, 'signIn']);
Route::post('signup', [AuthController::class, 'signUp']);

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('test', [AuthController::class, 'test']);

});

