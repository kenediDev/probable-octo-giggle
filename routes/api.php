<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'
], function () {
    Route::post('', [AuthController::class, 'login']);
    Route::post('reset/', [AuthController::class, 'reset']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/default'
], function () {
    Route::get('', [DefaultController::class, 'listProduct']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/service'
], function () {
    Route::post('', [ServiceController::class, 'create']);
    Route::delete('{id}', [ServiceController::class, 'destroy']);
    Route::post('{id}', [ServiceController::class, 'update']);
});
