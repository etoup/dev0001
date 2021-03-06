<?php

/**
 * Loops Management
 */
Route::group(['namespace' => 'Uc'], function() {
    Route::post('uc/get-info', 'UcController@getInfo')->name('open.uc.get-info');
    Route::post('uc/add-info', 'UcController@addInfo')->name('open.uc.add-info');
    Route::post('uc/get-user', 'UcController@getUser')->name('open.uc.get-user');
    Route::get('uc/token/{token}', 'UcController@token')->name('open.uc.token');

});