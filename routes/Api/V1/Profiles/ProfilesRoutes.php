<?php

use App\Http\Controllers\Api\V1\Profiles\ProfilesController;
use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'v1/profile',
  'middleware' => [
    'auth:sanctum',
    'validateType:job_seeker'
  ]
], function () {
  Route::patch('', [ProfilesController::class, 'update']);
  Route::get('', [ProfilesController::class, 'index']);
  Route::get('{id}', [ProfilesController::class, 'show']);
});
