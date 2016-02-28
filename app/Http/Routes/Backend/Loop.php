<?php

/**
 * Loop Management
 */
Route::group(['namespace' => 'Loop'], function() {
    Route::get('loop', 'LoopController@index')->name('admin.loop');
    Route::post('loop/search', 'LoopController@search')->name('admin.loop.search');
    Route::get('loop/create', 'LoopController@create')->name('admin.loop.create');
    Route::get('loop/edit/{id}', 'LoopController@edit')->name('admin.loop.edit');
    Route::delete('loop/destroy/{id}', 'LoopController@destroy')->name('admin.loop.destroy');
    Route::get('loop/cancel-top/{id}', 'LoopController@cancelTop')->name('admin.loop.cancel-top');
    Route::get('loop/do-top/{id}', 'LoopController@doTop')->name('admin.loop.do-top');
    Route::post('loop/store', 'LoopController@store')->name('admin.loop.store');
    Route::post('loop/update', 'LoopController@storeClear')->name('admin.loop.update');
    Route::post('loop/export', 'LoopController@export')->name('admin.loop.export');
    Route::get('loop/msg-list/{id}', 'LoopController@msgList')->name('admin.loop.msg-list');
    Route::post('loop/msg-search', 'LoopController@msgSearch')->name('admin.loop.msg-search');
    Route::delete('loop/msg-destroy/{id}', 'LoopController@msgDestroy')->name('admin.loop.msg-destroy');

    Route::resource('loop/tags','LoopTagsController');
    Route::resource('loop/authority','LoopAuthorityController');
});