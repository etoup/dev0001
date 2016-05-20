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
    Route::post('messages/share', 'MessagesController@share')->name('open.messages.share');
    Route::post('messages/get-messages', 'MessagesController@getMessages')->name('open.messages.get-messages');
    Route::get('messages/images/{id}', 'MessagesController@getImages')->name('open.messages.images');
    Route::post('messages/images', 'MessagesController@images')->name('open.messages.images');
    Route::post('messages/pictures-follows', 'MessagesController@picturesFollows')->name('open.messages.pictures-follows');
    Route::post('messages/get-diaries', 'MessagesController@getDiaries')->name('open.messages.get-diaries');
    Route::post('messages/create-diary', 'MessagesController@createDiary')->name('open.messages.create-diary');
});