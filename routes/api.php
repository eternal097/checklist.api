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

Route::namespace('Api')->group(function () {
    //Registration and Authorization
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    //Middleware auth:api
    Route::middleware('auth:api')->group(function () {
        //Logout
        Route::post('/logout', 'AuthController@logout');
        //Checklists resource
        Route::resource('checklists','ChecklistController');
        //Tasks resource
        Route::resource('checklists/{id}/tasks','TaskController');
    });
});
