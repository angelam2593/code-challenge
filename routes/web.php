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

Route::get('/', "SearchController@index")->name('home');
Route::post('/search', "SearchController@search");
Route::get('search_artist/{id}', 'SearchController@searchArtist')->name('search_artists');
Route::get('search_album/{id}', 'SearchController@searchAlbum')->name('search_albums');
Route::get('search_track/{id}', 'SearchController@searchTrack')->name('search_tracks');
