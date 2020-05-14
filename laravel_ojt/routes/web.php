<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Auth\LoginController@showLoginForm');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/posts', 'PostController', ['except' => 'show']);
Route::post('posts/confirm', 'PostController@confirm')->name('posts.confirm');
Route::post('posts/{id}/updateConfirm', 'PostController@updateConfirm')->name('posts.updateConfirm');
Route::get('/upload', 'PostController@upload')->name('upload');
Route::post('import', 'PostController@import')->name('import');
Route::get('export', 'PostController@export')->name('export');



Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/create', 'UserController@create');
Route::post('users/confirm', 'UserController@confirm')->name('users.confirm');
Route::post('/users', 'UserController@store')->name('users.store');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
Route::get('/users/{user}', 'UserController@profile')->name('users.profile');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::post('users/{id}/updateConfirm', 'UserController@updateConfirm')->name('users.updateConfirm');
Route::put('/users/{id}', 'UserController@update')->name('users.update');



