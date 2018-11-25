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
    Route::resource('size', 'Admin\SizeController');
    Route::resource('brand', 'Admin\BrandController');
    Route::resource('order', 'Admin\OrderController');

    Route::resource('productlist', 'Admin\ProductlistController');

    Route::resource('userdetail','Admin\UserdetailController');
    Route::resource('setting','Admin\SettingController');

    Route::post('/promo/sortit', 'Admin\PromoController@sortit');
    Route::post('/info/sortit', 'Admin\InfoController@sortit');
    Route::post('/contenttype/sortit', 'Admin\ContenttypeController@sortit');
    Route::post('/content/sortit', 'Admin\ContentController@sortit');
    Route::post('/bannertype/sortit', 'Admin\BannertypeController@sortit');
    Route::post('/banner/sortit', 'Admin\BannerController@sortit');
    Route::post('/banner/upload', 'Admin\BannerController@upload');
    Route::post('/outlet/sortit', 'Admin\OutletController@sortit');
    Route::post('/paymentmethod/sortit', 'Admin\PaymentmethodController@sortit');
    Route::post('/productlist/sortit', 'Admin\ProductlistController@sortit');
    Route::post('/size/sortit', 'Admin\SizeController@sortit');

    Route::get('/products', 'Admin\ProductController@index')->name('product.index');
    Route::get('/product/create', 'Admin\ProductController@create')->name('product.create');
    Route::post('/product', 'Admin\ProductController@store')->name('product.store');
    Route::get('/product/{product}/edit', 'Admin\ProductController@edit')->name('product.edit');
    Route::put('/product/{product}', 'Admin\ProductController@update')->name('product.update');

    Route::get('/product/prices', 'Admin\ProductController@getprices')->name('product.prices');
    Route::post('/product/price', 'Admin\ProductController@saveprice');
    Route::post('/product/price/delete', 'Admin\ProductController@deleteprice');
    Route::post('/product/price/color', 'Admin\ProductController@addcolor');
    Route::post('/product/price/color/remove', 'Admin\ProductController@removecolor');
    Route::delete('/product/{product}', 'Admin\ProductController@destroy');

    Route::post('/image/upload', 'Admin\UploadController@upload')->name('image.upload');
    Route::post('/image/savecaption', 'Admin\UploadController@savecaption')->name('image.savecaption');
    Route::post('/image/sort', 'Admin\UploadController@imagesort')->name('image.imagesort');
    Route::post('/image/delete', 'Admin\UploadController@removePic')->name('image.destroy');
    Route::post('/image/search' , 'Admin\UploadController@searchimage')->name('image.search');

});

// Route::middleware(['auth', 'is_admin'])->group(function () {
    
// });



