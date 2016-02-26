<?php
Breadcrumbs::register('admin.orders.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.orders.main'), route('admin.orders'));
});
Breadcrumbs::register('admin.orders', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.orders.index');
    $breadcrumbs->push(trans('menus.backend.orders.list'), route('admin.orders'));
});



