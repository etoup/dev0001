<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(trans('menus.backend.sidebar.dashboard'), route('admin.dashboard'));
});

require __DIR__ . '/Access.php';
require __DIR__ . '/LogViewer.php';
require __DIR__ . '/Loop.php';
require __DIR__ . '/Goods.php';
require __DIR__ . '/Orders.php';