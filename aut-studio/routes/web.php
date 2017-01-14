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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@home');

Route::get('games', 'GameController@game');
Route::get('games/{title}/header', 'GameController@header');
Route::get('games/{title}/info', 'GameController@info');
Route::get('games/{title}/leaderboard', 'GameController@leaderboard');
Route::get('games/{title}/comments', 'GameController@comments');
Route::get('games/{title}/related_games', 'GameController@relatedGames');
Route::post('games/{title}/submit-comment', 'GameController@submitComment');

Route::get('games_list', 'GameController@games');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('profile', 'ProfileController@profile');
Route::get('images/user-avatars/{avatar}', 'ProfileController@avatar');
Route::post('profile/upload-avatar', 'ProfileController@uploadAvatar');
Route::post('profile/change-user-password', 'ProfileController@changeUserPassword');
Route::get('profile/categories', 'ProfileController@categories');
Route::post('profile/update-favorite-categories', 'ProfileController@updateFavoriteCategories');

Route::get('/admin', 'AdminController@index')->name('games');
Route::get('game/create', 'AdminController@createGame');
Route::post('game/create', 'AdminController@create');
Route::delete('game/{id}', 'AdminController@delete');
Route::get('game/{id}/edit', 'AdminController@editGame');
Route::put('game/{id}/edit', 'AdminController@edit');