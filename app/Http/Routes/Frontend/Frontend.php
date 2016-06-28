<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('app', 'FrontendController@app')->name('frontend.app');
//Route::post('upload', 'UploadController@index')->name('frontend.upload');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
//        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
//        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
});