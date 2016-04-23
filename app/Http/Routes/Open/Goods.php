<?php

/**
 * Goods Management
 */
Route::group(['namespace' => 'Goods'], function() {
    Route::get('goods/index/{page}', 'GoodsController@index')->name('open.goods.index');
    Route::get('goods/info/{id}/{uid}', 'GoodsController@getInfo')->name('open.goods.info');
    Route::post('goods/info', 'GoodsController@info')->name('open.goods.info');
    Route::post('goods/goods-info', 'GoodsController@goodsInfo')->name('open.goods.goods-info');
});