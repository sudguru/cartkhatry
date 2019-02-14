<?php
Route::get('/account/dashboard', 'DashboardController@index')->name('account.dashboard');
Route::get('/password/change', 'DashboardController@change')->name('account.change');

Route::get('/account/info', 'AccountController@index')->name('account.info');
Route::post('/account/info', 'AccountController@update');
Route::get('/account/logocover', 'AccountController@logocover')->name('account.logocover');
Route::post('/account/logo', 'AccountController@logo')->name('account.logo');
Route::post('/account/cover', 'AccountController@cover')->name('account.cover');

Route::get('/account/product/create', 'MerchantController@productcreate')->name('account.product.create');
Route::get('/account/products', 'MerchantController@productindex')->name('account.product.index');
Route::post('/account/product', 'MerchantController@productstore')->name('account.product.store');
Route::get('/account/product/{product}/edit', 'MerchantController@productedit')->name('account.product.edit');
Route::put('/account/product/{product}', 'MerchantController@productupdate')->name('account.product.update');
Route::delete('/account/product/{product}', 'MerchantController@productdestroy')->name('account.product.destroy');

Route::get('/account/orders', 'MerchantController@myorders')->name('account.orders.index');

Route::post('/account/product/price', 'MerchantController@saveprice')->name('account.price.store');
Route::post('/account/product/price/delete', 'MerchantController@deleteprice')->name("account.price.destroy");
Route::post('/product/updateprice', 'MerchantController@updateprice')->name('account.price.update');
Route::post('/product/stockupdate', 'MerchantController@updatestock')->name('account.price.stockupdate');

Route::post('/account/image/upload', 'Admin\UploadController@upload')->name('account.image.upload');
Route::post('/account/image/savecaption', 'Admin\UploadController@savecaption')->name('account.image.savecaption');
Route::post('/account/image/sort', 'Admin\UploadController@imagesort')->name('account.image.imagesort');
Route::post('/account/image/delete', 'Admin\UploadController@removePic')->name('account.image.destroy');
Route::post('/account/image/search' , 'Admin\UploadController@searchimage')->name('account.image.search');