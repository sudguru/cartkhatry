<?php
Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');

Route::get('/account/info', 'AccountController@index')->name('account.info');
Route::post('/account/info', 'AccountController@update');

Route::get('/account/products', 'ProductController@index')->name('account.product.index');
Route::get('/account/product/create', 'ProductController@create')->name('account.product.create');
Route::post('/account/product', 'ProductController@store')->name('account.product.store');
Route::get('/account/product/{product}/edit', 'ProductController@edit')->name('account.product.edit');
Route::put('/account/product/{product}', 'ProductController@update')->name('account.product.update');

Route::get('/account/product/prices', 'ProductController@getprices')->name('account.product.prices');
Route::post('/account/product/price', 'ProductController@saveprice');
Route::post('/account/product/price/delete', 'ProductController@deleteprice');
Route::post('/account/product/price/color', 'ProductController@addcolor');
Route::post('/account/product/price/color/remove', 'ProductController@removecolor');
Route::delete('/account/product/{product}', 'ProductController@destroy');

Route::post('/image/upload', 'UploadController@upload')->name('image.upload');
Route::post('/image/savecaption', 'UploadController@savecaption')->name('image.savecaption');
Route::post('/image/sort', 'UploadController@imagesort')->name('image.imagesort');
Route::post('/image/delete', 'UploadController@removePic')->name('image.destroy');
Route::post('/image/search' , 'UploadController@searchimage')->name('image.search');