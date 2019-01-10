<?php
Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');
Route::get('/password/change', 'DashboardController@change')->name('account.change');

Route::get('/account/info', 'AccountController@index')->name('account.info');
Route::post('/account/info', 'AccountController@update');

Route::get('/account/product/create', 'DashboardController@productcreate')->name('account.product.create');
Route::get('/account/products', 'DashboardController@productindex')->name('account.product.index');
Route::post('/account/product', 'DashboardController@productstore')->name('account.product.store');
Route::get('/account/product/{product}/edit', 'DashboardController@productedit')->name('account.product.edit');
Route::put('/account/product/{product}', 'DashboardController@productupdate')->name('account.product.update');
Route::delete('/account/product/{product}', 'DashboardController@productdestroy')->name('account.product.destroy');

