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


Route::post('register', 'UserController@register');
// register masih ada bug,
// register harus menambahkan satu field lagi yaitu 'password_confirmation'

Route::post('login', 'UserController@login');

// Route::get('checklist', 'ChecklistController@index');
// Route::post('checklist', 'ChecklistController@store');
// Route::delete('checklist/{id}', 'ChecklistController@destroy');

// Route::get('checklist/{checklistid}/item', 'ChecklistItemController@index');
// Route::post('checklist/{checklistid}/item', 'ChecklistItemController@store');
// Route::delete('checklist/{checklistid}/item/{checklistitemid}', 'ChecklistItemController@destroy');


// jwt auth masih ada bug (tidak dapat membaca token dari authorization)
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('checklist', 'ChecklistController@index');
    Route::post('checklist', 'ChecklistController@store');
    Route::delete('checklist/{id}', 'ChecklistController@destroy');

    Route::get('checklist/{checklistid}/item', 'ChecklistItemController@index');
    Route::post('checklist/{checklistid}/item', 'ChecklistItemController@store');
Route::delete('checklist/{id}', 'ChecklistController@destroy');
});
