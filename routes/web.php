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
    return view('welcome');
});

Route::get('/login', 'AuthController@showLogin')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'custom.auth'], function () {
   
    Route::get('/movies', 'MovieController@index');
    Route::get('/movies/{id}', 'MovieController@detail');

    Route::post('/favorites', 'FavoriteController@store');
    Route::get('/favorites', 'FavoriteController@index');
    Route::delete('/favorites/{id}', 'FavoriteController@destroy');

    Route::get('/lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'id'])) {
            session(['locale' => $locale]);
        }
        return back();
    });

});





