<?php

Route::group(['middleware' => 'web'], function() {
    /**
     * Switch between the included languages
     */
    Route::group(['namespace' => 'Language'], function () {
        require (__DIR__ . '/Routes/Language/Language.php');
    });

    /**
     * Frontend Routes
     * Namespaces indicate folder structure
     */
    Route::group(['namespace' => 'Frontend'], function () {
        require (__DIR__ . '/Routes/Frontend/Frontend.php');
        require (__DIR__ . '/Routes/Frontend/Access.php');
    });
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    /**
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    require (__DIR__ . '/Routes/Backend/Dashboard.php');
    require (__DIR__ . '/Routes/Backend/Access.php');
    require (__DIR__ . '/Routes/Backend/LogViewer.php');
    require (__DIR__ . '/Routes/Backend/Loop.php');
    require (__DIR__ . '/Routes/Backend/Goods.php');
    require (__DIR__ . '/Routes/Backend/Orders.php');
});

/**
 * Open Routes
 */
Route::group(['namespace' => 'Open', 'prefix' => 'open', 'middleware' => 'api'], function () {
    require (__DIR__ . '/Routes/Open/Uc.php');
    require (__DIR__ . '/Routes/Open/My.php');
    require (__DIR__ . '/Routes/Open/Loops.php');
    require (__DIR__ . '/Routes/Open/Goods.php');
    require (__DIR__ . '/Routes/Open/Orders.php');
    require (__DIR__ . '/Routes/Open/Messages.php');

});

