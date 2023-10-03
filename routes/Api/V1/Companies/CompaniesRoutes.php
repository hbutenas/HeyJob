<?php

use App\Http\Controllers\Api\V1\Companies\CompaniesController;
use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'v1/company',
  'middleware' => [
    'auth:sanctum',
    'validateType:employer'
  ]
], function () {
  Route::patch('', [CompaniesController::class, 'update']);
  Route::get('', [CompaniesController::class, 'index']);
  Route::get('{id}', [CompaniesController::class, 'show']);
});
