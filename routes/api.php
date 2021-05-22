<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ListCoverInformationController;
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
    Route::post('update/', [AuthController::class, 'update']);
    Route::get('me/', [AuthController::class, 'me']);
    Route::post('background/', [AuthController::class, 'addBackground']);
    Route::delete('background/{id}', [AuthController::class, 'destroyBackground']);
    Route::post('background/{id}', [AuthController::class, 'updateBackground']);
    Route::post('update/profile/', [AuthController::class, 'updateProfile']);
    Route::post('title/', [AuthController::class, 'updateTitle']);
    Route::post("animation/", [AuthController::class, "activeAnimation"]);
    Route::post('update/information/', [AuthController::class, "updateCoverInformation"]);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/default'
], function () {
    Route::get('', [DefaultController::class, 'listProduct']);
    Route::get('icon/', [DefaultController::class, 'listIcon']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/service'
], function () {
    Route::post('', [ServiceController::class, 'create']);
    Route::delete('{id}', [ServiceController::class, 'destroy']);
    Route::post('{id}', [ServiceController::class, 'update']);
    Route::post('active/{id}', [ServiceController::class, 'service_animation']);
});


Route::group([
    'middleware' => "api",
    'prefix' => "v1/information"
], function () {
    Route::post('', [ListCoverInformationController::class, "create"]);
    Route::delete("{id}", [ListCoverInformationController::class, 'destroy']);
    Route::post('{id}', [ListCoverInformationController::class, 'update']);
});
