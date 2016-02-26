<?php
Breadcrumbs::register('admin.goods.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.goods.main'), route('admin.goods'));
});
Breadcrumbs::register('admin.goods', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.goods.index');
    $breadcrumbs->push(trans('menus.backend.goods.list'), route('admin.goods'));
});
Breadcrumbs::register('admin.goods.look', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.goods.index');
    $breadcrumbs->push(trans('menus.backend.goods.look'), route('admin.goods.look'));
});



