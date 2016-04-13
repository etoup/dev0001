<?php

/**
 * Loops Management
 */
Route::group(['namespace' => 'Uc'], function() {
    Route::post('uc/get-info', 'UcController@getInfo')->name('open.uc.get-info');
    Route::post('uc/add-info', 'UcController@addInfo')->name('open.uc.add-info');
});