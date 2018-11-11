<?php
Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');

Route::get('/account/info', 'AccountController@index')->name('account.info');
Route::post('/account/info', 'AccountController@update');

Route::get('/account/product/create', 'ProductController@create')->name('account.product.create');
Route::post('/account/product', 'ProductController@store')->name('account.product.store');
Route::get('/account/product/{{product}}/edit', 'ProductController@edit')->name('account.product.edit');