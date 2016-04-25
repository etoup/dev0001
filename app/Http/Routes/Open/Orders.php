<?php

/**
 * Orders Management
 */
Route::group(['namespace' => 'Ods'], function() {
    Route::post('orders/create', 'OrdersController@createOrders')->name('open.orders.create');
    Route::post('orders/buyer', 'OrdersController@buyer')->name('open.orders.buyer');
    Route::any('orders/pay', 'OrdersController@pay')->name('open.orders.pay');
    Route::post('orders/bought', 'OrdersController@bought')->name('open.orders.bought');

});