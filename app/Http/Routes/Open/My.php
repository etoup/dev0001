<?php

/**
 * My Management
 */
Route::group(['namespace' => 'My'], function() {
    Route::get('my/loops/{uid}/{page}', 'MyController@getLoops')->name('open.my.loops');
    Route::get('my/goods/{uid}', 'MyController@getGoods')->name('open.my.goods');
    Route::get('my/sales/{uid}/{page}', 'MyController@getSales')->name('open.my.sales');
    Route::get('my/follows-goods/{uid}/{page}', 'MyController@getFollowsGoods')->name('open.my.follows-goods');
    Route::get('my/follows-loops/{uid}/{page}', 'MyController@getFollowsLoops')->name('open.my.follows-loops');

    Route::post('my/loops', 'MyController@loops')->name('open.my.loops');
    Route::post('my/goods', 'MyController@goods')->name('open.my.goods');
    Route::post('my/sales', 'MyController@sales')->name('open.my.sales');
    Route::post('my/follows-goods', 'MyController@followsGoods')->name('open.my.follows-goods');
    Route::post('my/follows-loops', 'MyController@followsLoops')->name('open.my.follows-loops');
    Route::post('my/orders-unpaid', 'MyController@ordersUnpaid')->name('open.my.orders-unpaid');
    Route::post('my/orders-paid', 'MyController@ordersPaid')->name('open.my.orders-paid');
    Route::post('my/orders-delivery', 'MyController@ordersDelivery')->name('open.my.orders-delivery');
    Route::post('my/orders-deal', 'MyController@ordersDeal')->name('open.my.orders-deal');
    Route::post('my/delete-loops', 'MyController@deleteLoops')->name('open.my.delete-loops');
    Route::post('my/pulled', 'MyController@pulled')->name('open.my.pulled');
    Route::post('my/delivery', 'MyController@delivery')->name('open.my.delivery');
    Route::post('my/out', 'MyController@out')->name('open.my.out');


});