<?php
Route::get('/local/{id}', 'LocalController@setLocal');

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/contacts', 'ContactController');

Route::get('/contacts-ajax', 'ContactController@viewAjax');
Route::get('/getAllAjax', 'ContactController@getAllAjax');
