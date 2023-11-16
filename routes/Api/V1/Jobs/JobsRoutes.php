<?php

use App\Http\Controllers\Api\V1\Jobs\JobsController;
use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'v1/job',
  'middleware' => [
    'auth:sanctum',
  ],
], function () {
  Route::post('', [JobsController::class, 'store'])->middleware('validateType:employer'); 
  Route::get('', [JobsController::class, 'index']); // This one should return applications together with the jobs
  Route::get('{id}', [JobsController::class, 'show']);
  Route::patch('{id}', [JobsController::class, 'update'])->middleware('validateType:employer');
  Route::delete('{id}', [JobsController::class, 'destroy'])->middleware('validateType:employer');
});
