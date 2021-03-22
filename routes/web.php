<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes();

//Admin panel
Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@show')->name('adminpanel');

    Route::get('/users', 'AdminController@showUserslist')->name('users');

    Route::get('/admins', 'AdminController@showAdminslist')->name('admins');

    Route::get('/checklists/{id}/tasks', 'AdminController@showTasks')->name('userTasks');

    Route::get('/checklists', 'AdminController@allChecklists')->name('allChecklists');

    Route::patch('/user/{id}}', 'AdminController@userUpdate')->name('userUpdate');

    Route::patch('/role/{id}}', 'AdminController@roleUpdate')->name('roleUpdate');

    Route::patch('/permission/{id}}', 'AdminController@permissionUpdate')->name('permissionUpdate');
});
