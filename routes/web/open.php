<?php


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/ajax/product-quick-view/{product}', 'HomeController@quickview');
Route::get('/product/{product}', 'HomeController@singleproduct');

Route::get('/changecurrency/{currency}', 'HomeController@changecurrency');
Route::get('/changeoutlet/{outlet_id/{outlet_name}', 'HomeController@changecurrency');

Route::get('/category/{category}', 'HomeController@category');

Route::get('/checkout/{product}/{qty}', 'CheckoutController@directcheckout');