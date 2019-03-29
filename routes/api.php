<?php

Route::group(['middleware' => "jwt.auth"], function () {
    Route::get('/user', 'ApiUserController@getUser');
    // Route::get('/product/cat/{id}', 'ApiProductController@getProduct');
    Route::post('/order', 'ApiOrderController@order');
    Route::get('/my_orders', 'ApiOrderController@myorders');
    Route::get('/cats', 'ApiProductController@getAllCats');
    Route::get('/product/{id}', 'ApiProductController@getSingleProduct');
//    Route::post('/imageUpload', 'ApiProductController@imageUpload');
//    Route::post('/newProduct', 'ApiProductController@newProduct');
});
Route::post('/register', 'ApiUserController@register');
Route::post('/login', 'ApiUserController@login');

Route::post('/imageUpload', 'ApiProductController@imageUpload');
Route::post('/newProduct', 'ApiProductController@newProduct');
Route::get('/product/cat/{id}', 'ApiProductController@getProduct');

