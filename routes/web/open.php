<?php


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/account/dashboard', 'HomeController@index')->name('account.dashboard');
