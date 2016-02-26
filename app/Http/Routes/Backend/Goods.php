<?php

/**
 * Goods Management
 */
Route::group(['namespace' => 'Goods'], function() {
    Route::get('goods', 'GoodsController@index')->name('admin.goods');
    Route::get('goods/look', 'GoodsController@look')->name('admin.goods.look');
    Route::get('goods/edit/{id}', 'GoodsController@edit')->name('admin.goods.edit');
    Route::post('goods/store', 'GoodsController@store')->name('admin.goods.store');
    Route::get('goods/down/{id}', 'GoodsController@down')->name('admin.goods.down');
    Route::post('goods/do-down', 'GoodsController@doDown')->name('admin.goods.do-down');
    Route::get('goods/look-ok/{id}', 'GoodsController@lookOk')->name('admin.goods.look-ok');
    Route::get('goods/look-no/{id}', 'GoodsController@lookNo')->name('admin.goods.look-no');
    Route::post('goods/do-look-no', 'GoodsController@doLookNo')->name('admin.goods.do-look-no');
    Route::delete('goods/destroy/{id}', 'GoodsController@destroy')->name('admin.goods.destroy');
});