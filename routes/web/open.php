<?php


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/ajax/product-quick-view/{product}', 'HomeController@quickview');
Route::get('/product/{product}', 'HomeController@singleproduct');

Route::get('/changecurrency/{currency}', 'HomeController@changecurrency');
Route::get('/changeoutlet/{outlet_id/{outlet_name}', 'HomeController@changecurrency');

Route::get('/category/{category}', 'HomeController@category');

Route::get('/checkoutdirect/{product}/{qty}/{priceid}', 'CheckoutController@directcheckout');
Route::get('/checkout', 'CheckoutController@checkout');

Route::post('/directorder/{product}/{priceid}/{qty}', 'CheckoutController@directorder')->name('directorder');
Route::get('/ordersuccessdirect/{order}/{product}', 'CheckoutController@ordersuccessdirect')->name('ordersuccessdirect');

Route::get('/add-to-cart/{product}', 'CheckoutController@addtocart')->name('addtocart');
