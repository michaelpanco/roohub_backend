<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::get('/pets', ['as' => 'pet_lists', 'uses' => 'PetController@index']);
    Route::get('/pet/{id}', ['as' => 'pet_details', 'uses' => 'PetController@details']);
    Route::post('/pets', ['as' => 'pet_create', 'uses' => 'PetController@create']);
    Route::put('/pet/{id}', ['as' => 'pet_update', 'uses' => 'PetController@update']);
});


//Route::get('pets', [PetController::class, 'index']);