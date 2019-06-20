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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('mypage', 'UserController@mypage')->name('mypage');
Route::get('mypage/edit', 'UserController@edit')->name('userEdit');
Route::post('updated/profile', 'UserController@update');

//Route::resource('photos','PhotosController');

Route::post('upload', 'PhotosController@store');
Route::post('comment', 'CommentsController@store');

Route::get('user/{id}', 'PhotosController@byUser')->name('byUser');
Route::delete('photo/{id}', 'PhotosController@destroy')->name('destroy');

Route::patch('photo/edit/{id}', 'PhotosController@update');

