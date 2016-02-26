<?php
Breadcrumbs::register('admin.access.roles.main', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.access.title'), route('admin.access.roles.permissions.index'));
});
require __DIR__ . '/Access/User.php';
require __DIR__ . '/Access/Role.php';
require __DIR__ . '/Access/Permission.php';
require __DIR__ . '/Access/PermissionGroup.php';