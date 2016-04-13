<?php

/**
 * My Management
 */
Route::group(['namespace' => 'My'], function() {
    Route::get('my/loops/{uid}/{page}', 'MyController@getLoops')->name('open.my.loops');
    Route::post('my/loops', 'MyController@loops')->name('open.my.loops');
});