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

Route::post('/account/product/price', 'DashboardController@saveprice')->name('account.price.store');
Route::post('/account/product/price/delete', 'DashboardController@deleteprice')->name("account.price.destroy");

Route::post('/account/image/upload', 'Admin\UploadController@upload')->name('account.image.upload');
Route::post('/account/image/savecaption', 'Admin\UploadController@savecaption')->name('account.image.savecaption');
Route::post('/account/image/sort', 'Admin\UploadController@imagesort')->name('account.image.imagesort');
Route::post('/account/image/delete', 'Admin\UploadController@removePic')->name('account.image.destroy');
Route::post('/account/image/search' , 'Admin\UploadController@searchimage')->name('account.image.search');