<?php

/**
 * Goods Management
 */
Route::group(['namespace' => 'Orders'], function() {
    Route::get('orders', 'OrdersController@index')->name('admin.orders');
    Route::get('orders/see/{id}', 'OrdersController@see')->name('admin.orders.see');
    Route::get('orders/edit/{id}', 'OrdersController@edit')->name('admin.orders.edit');
    Route::post('orders/store', 'OrdersController@store')->name('admin.orders.store');
    Route::delete('orders/destroy/{id}', 'OrdersController@destroy')->name('admin.orders.destroy');
});