<?php
Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');
Route::get('/password/change', 'DashboardController@change')->name('account.change');

Route::get('/account/info', 'AccountController@index')->name('account.info');
Route::post('/account/info', 'AccountController@update');

Route::get('/account/product/create', 'DashboardController@create')->name('account.product.create');
Route::get('/account/products', 'DashboardController@productindex')->name('account.product.index');

