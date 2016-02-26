<?php
Breadcrumbs::register('admin.loop.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.loop.main'), route('admin.loop'));
});
Breadcrumbs::register('admin.loop', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.loop.index');
    $breadcrumbs->push(trans('menus.backend.loop.list'), route('admin.loop'));
});
Breadcrumbs::register('admin.loop.tags.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.loop.index');
    $breadcrumbs->push(trans('menus.backend.loop.tags'), route('admin.loop.tags.index'));
});
Breadcrumbs::register('admin.loop.authority.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.loop.index');
    $breadcrumbs->push(trans('menus.backend.loop.authority'), route('admin.loop.authority.index'));
});



