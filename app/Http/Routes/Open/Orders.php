<?php

/**
 * Orders Management
 */
Route::group(['namespace' => 'Ods'], function() {
    Route::post('orders/info', 'OrdersController@info')->name('open.orders.info');
    Route::post('orders/create', 'OrdersController@createOrders')->name('open.orders.create');
    Route::post('orders/buyer', 'OrdersController@buyer')->name('open.orders.buyer');
    Route::post('orders/bought', 'OrdersController@bought')->name('open.orders.bought');
    Route::any('orders/pay', 'OrdersController@pay')->name('open.orders.pay');
});