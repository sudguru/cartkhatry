<?php


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/ajax/product-quick-view/{product}', 'HomeController@quickview');
