<?php

/**
 * Goods Management
 */
Route::group(['namespace' => 'Goods'], function() {
    Route::get('goods/index/{page}', 'GoodsController@index')->name('open.goods.index');

});