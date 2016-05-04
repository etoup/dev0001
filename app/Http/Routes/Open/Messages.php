<?php

/**
 * Messages Management
 */
Route::group(['namespace' => 'Loops'], function() {
    Route::get('messages/index/{id}', 'MessagesController@index')->name('open.messages.index');
    Route::post('messages/text', 'MessagesController@text')->name('open.messages.text');
    Route::post('messages/img', 'MessagesController@img')->name('open.messages.img');
    Route::post('messages/photo', 'MessagesController@photo')->name('open.messages.photo');
    Route::post('messages/goods', 'MessagesController@goods')->name('open.messages.goods');

});