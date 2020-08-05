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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function(){    
    Route::get('/students', 'StudentController@index');
    Route::get('/students/{student}', 'StudentController@show');
    Route::post('/students', 'StudentController@store');
    Route::put('/students/{student}', 'StudentController@update');
    Route::delete('/students/{student}', 'StudentController@destroy');
});