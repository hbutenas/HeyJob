<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Applications\ApplicationsController;


Route::group([
  'prefix' => 'v1/applications',
  'middleware' => [
    'auth:sanctum'
  ],
], function () {
  Route::post('{id}', [ApplicationsController::class, 'apply'])->middleware('validateType:job_seeker');
  Route::get('', [ApplicationsController::class, 'index'])->middleware('validateType:job_seeker'); 
  Route::get('{id}', [ApplicationsController::class, 'show'])->middleware('validateType:job_seeker'); 
});