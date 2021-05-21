<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'AuthController@login');

Route::get('/unauthorized', 'AuthController@unauthorized')->name('unauthorized');
Route::get('/forbidden', 'AuthController@forbidden')->name('forbidden');

Route::middleware('auth:api')->group(function() {

    Route::delete('/logout', 'AuthController@logout');

});
