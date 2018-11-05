<?php


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');
Route::get('/account/info', 'AccountController@index')->name('account.info');
