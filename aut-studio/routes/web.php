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

Route::get('/', function () {
    return view('index');
});

//Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/games', 'GameController@game');
Route::get('/games/{title}/header', 'GameController@header');
Route::get('/games/{title}/info', 'GameController@info');
Route::get('/games/{title}/leaderboard', 'GameController@leaderboard');
Route::get('/games/{title}/comments', 'GameController@comments');