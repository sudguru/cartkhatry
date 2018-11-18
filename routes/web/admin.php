<?php

Route::prefix('adm')->middleware(['auth', 'is_admin'])->group(function () {
    
    Route::get('/', 'Admin\AdminController@index');

    Route::resource('promo', 'Admin\PromoController');
    Route::resource('info', 'Admin\InfoController');
    Route::resource('contenttype', 'Admin\ContenttypeController');
    Route::resource('content', 'Admin\ContentController');
    Route::resource('bannertype', 'Admin\BannertypeController');
    Route::resource('banner', 'Admin\BannerController');
    Route::resource('outlet', 'Admin\OutletController');

    Route::resource('category', 'Admin\CategoryController');
    Route::resource('paymentmethod', 'Admin\PaymentmethodController');
    Route::resource('product', 'Admin\ProductController');
    Route::resource('order', 'Admin\OrderController');

    Route::resource('productlist', 'Admin\ProductlistController');

    Route::resource('userdetail','Admin\UserdetailController');
    Route::resource('setting','Admin\SettingController');

});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::post('/promo/sortit', 'Admin\PromoController@sortit');
    Route::post('/info/sortit', 'Admin\InfoController@sortit');
    Route::post('/contenttype/sortit', 'Admin\ContenttypeController@sortit');
    Route::post('/content/sortit', 'Admin\ContentController@sortit');
    Route::post('/bannertype/sortit', 'Admin\BannertypeController@sortit');
    Route::post('/banner/sortit', 'Admin\BannerController@sortit');
    Route::post('/banner/upload', 'Admin\BannerController@upload');
    Route::post('/paymentmethod/sortit', 'Admin\PaymentmethodController@sortit');
});
