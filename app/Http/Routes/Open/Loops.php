<?php

/**
 * Loops Management
 */
Route::group(['namespace' => 'Loops'], function() {
    Route::post('loops/tags', 'LoopsController@tags')->name('open.loops.tags');
    Route::get('loops/index/{tags_id}/{page}', 'LoopsController@index')->name('open.loops.index');
    Route::get('loops/hot/{tags_id}/{page}', 'LoopsController@hot')->name('open.loops.hot');
    Route::get('loops/follows/{uid}/{page}', 'LoopsController@follows')->name('open.loops.follows');
    Route::post('loops/has-follows', 'LoopsController@hasFollows')->name('open.loops.has-follows');
    Route::post('loops/join', 'LoopsController@join')->name('open.loops.join');
    Route::post('loops/get-cate', 'LoopsController@getCate')->name('open.loops.get-cate');
    Route::post('loops/get-doing', 'LoopsController@getDoing')->name('open.loops.get-doing');
    Route::post('loops/get-doing-tags', 'LoopsController@getDoingTags')->name('open.loops.get-doing-tags');
    Route::get('loops/goods/{loops_id}/{page}', 'LoopsController@goods')->name('open.loops.goods');
    Route::get('loops/users/{loops_id}/{page}', 'LoopsController@users')->name('open.loops.users');
    Route::post('loops/del-users', 'LoopsController@delUsers')->name('open.loops.del-users');
});