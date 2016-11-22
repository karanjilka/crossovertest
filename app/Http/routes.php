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

Route::get('/',array('as' => 'home','uses' => 'FrontNewsController@index'));
Route::get('news/show/{id}',['uses' => 'FrontNewsController@show']);
Route::get('news/feed',['uses' => 'FrontNewsController@feed']);
Route::get('news/pdf/{id}',['uses' => 'FrontNewsController@pdf']);

Route::group(['prefix' => 'user'], function () {
    Route::resource('news', 'NewsController', ['only' => [
            'index', 'create', 'store', 'destroy'
    ]]);
});