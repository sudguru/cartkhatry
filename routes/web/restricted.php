<?php
Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');

Route::get('/account/info', 'AccountController@index')->name('account.info');
Route::post('/account/info', 'AccountController@update');

