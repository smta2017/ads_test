<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('ads-filter', [App\Http\Controllers\API\AdAPIController::class,'adFilter']);
Route::resource('ads', App\Http\Controllers\API\AdAPIController::class);


Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class);


Route::resource('tags', App\Http\Controllers\API\TagAPIController::class);


Route::resource('adTags', App\Http\Controllers\API\AdTagAPIController::class);
