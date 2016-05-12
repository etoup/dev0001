<?php

/**
 * Loops Management
 */
Route::group(['namespace' => 'Loops'], function() {
    Route::post('loops/tags', 'LoopsController@tags')->name('open.loops.tags');
    Route::post('loops/index', 'LoopsController@index')->name('open.loops.index');
    Route::post('loops/hot', 'LoopsController@hot')->name('open.loops.hot');
    Route::post('loops/follows', 'LoopsController@follows')->name('open.loops.follows');
    Route::post('loops/has-follows', 'LoopsController@hasFollows')->name('open.loops.has-follows');
    Route::post('loops/join', 'LoopsController@join')->name('open.loops.join');
    Route::post('loops/get-cate', 'LoopsController@getCate')->name('open.loops.get-cate');
    Route::post('loops/get-doing', 'LoopsController@getDoing')->name('open.loops.get-doing');
    Route::post('loops/get-doing-tags', 'LoopsController@getDoingTags')->name('open.loops.get-doing-tags');
    Route::post('loops/goods', 'LoopsController@goods')->name('open.loops.goods');
    Route::post('loops/users', 'LoopsController@users')->name('open.loops.users');
    Route::post('loops/del-users', 'LoopsController@delUsers')->name('open.loops.del-users');
});