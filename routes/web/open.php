<?php


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/ajax/product-quick-view/{product}', 'HomeController@quickview');
Route::get('/product/{product}', 'HomeController@singleproduct');

Route::get('/changecurrency/{currency}', 'HomeController@changecurrency');
Route::get('/changeoutlet/{outlet_id/{outlet_name}', 'HomeController@changecurrency');

Route::get('/category/{category}', 'HomeController@category');

Route::get('/checkoutdirect/{product}/{qty}/{priceid}', 'CheckoutController@directcheckout');
Route::post('/directorder/{product}/{priceid}/{qty}', 'CheckoutController@directorder')->name('directorder');
Route::get('/ordersuccessdirect/{order}/{product}', 'CheckoutController@ordersuccessdirect')->name('ordersuccessdirect');

Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/cartorder', 'CheckoutController@cartorder')->name('cartorder');
Route::get('/orderpreview', 'CheckoutController@orderpreview')->name('orderpreview');
Route::get('/ordersuccess/{order}', 'CheckoutController@ordersuccess')->name('ordersuccess');

Route::get('/add-to-cart/{product}/{price}/{qty}', 'CartController@addtocart')->name('addtocart');
Route::get('/viewcart', 'CartController@viewcart')->name('viewcart');
Route::get('/cartremoveitem/{itemindex}', 'CartController@cartremoveitem')->name('cartremoveitem');
Route::get('/clearcart', 'CartController@clearcart')->name('clearcart');

