<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'v1/auth'
], function () {
  Route::post('register', [AuthController::class, 'register']);
  Route::post('login', [AuthController::class, 'login']);
});


Route::group([
  'prefix' => 'v1/auth',
  'middleware' => ['auth:sanctum']
], function () {
  Route::post('logout', [AuthController::class, 'logout']);
});