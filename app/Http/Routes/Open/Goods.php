<?php

/**
 * Goods Management
 */
Route::group(['namespace' => 'Goods'], function() {
    Route::post('goods/index', 'GoodsController@index')->name('open.goods.index');
    Route::get('goods/info/{id}/{uid}', 'GoodsController@getInfo')->name('open.goods.info');
    Route::post('goods/info', 'GoodsController@info')->name('open.goods.info');
    Route::post('goods/goods-info', 'GoodsController@goodsInfo')->name('open.goods.goods-info');
    Route::post('goods/cancel-follows', 'GoodsController@cancelFollows')->name('open.goods.cancel-follows');
    Route::post('goods/follows', 'GoodsController@follows')->name('open.goods.follows');
    Route::post('goods/images', 'GoodsController@images')->name('open.goods.images');

});