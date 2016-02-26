<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => '权限管理',

            'permissions' => [
                'all' => '节点',
                'create' => '创建权限节点',
                'edit' => '编辑权限节点',
                'groups' => [
                    'all' => '全部权限组',
                    'create' => '创建权限组',
                    'edit' => '编辑权限组',
                    'main' => '权限',
                ],
                'main' => '权限节点',
                'management' => '权限',
            ],

            'roles' => [
                'all' => '角色',
                'create' => '创建角色',
                'edit' => '编辑角色',
                'management' => '角色管理',
                'main' => '角色',
            ],

            'users' => [
                'all' => '用户',
                'change-password' => '修改密码',
                'create' => '创建用户',
                'deactivated' => '禁用用户',
                'deleted' => '删除用户',
                'edit' => '编辑用户',
                'main' => '用户',
            ],

        ],

        'log-viewer' => [
            'main' => '日志管理',
            'dashboard' => '统计',
            'logs' => '列表',
        ],

        'loop' => [
            'main' => '圈子管理',
            'list' => '圈子列表',
            'tags' => '类别管理',
            'authority' => '权限管理',
            'create' => '创建圈子',
            'tags_list' => '类别列表',
            'create_tags' => '创建类别',
            'authorith' => [
                'create' => '创建权限'
            ]
        ],
        'goods' => [
            'main' => '商品管理',
            'list' => '商品列表',
            'look' => '商品审核'
        ],
        'orders' => [
            'main' => '订单管理',
            'list' => '订单列表'
        ],

        'sidebar' => [
            'home'=>'首页',
            'dashboard' => '控制台',
            'general' => '导航列表',
        ],

        'shortcut_link' => '快捷链接'
    ],


];
