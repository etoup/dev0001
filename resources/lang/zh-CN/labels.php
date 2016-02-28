<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => '全部',
        'actions' => '操作',
        'buttons' => [
            'save' => '保存',
            'update' => '更新',
        ],
        'hide' => 'Hide',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => '切换导航',
    ],

    'backend' => [
        'total' => '共计 :total 条记录',
        'total_days' => '共计 :total 天记录',
        'table'=> [
            'nolists' => '没有数据信息'
        ],
        'access' => [
            'permissions' => [
                'create' => '创建权限',
                'dependencies' => '依赖',
                'edit' => '编辑权限节点',

                'groups' => [
                    'create' => '创建权限组',
                    'edit' => '编辑权限组',

                    'table' => [
                        'name' => '名称',
                    ],
                ],

                'grouped_permissions' => '分组权限',
                'label' => '－ 权限节点',
                'management' => '权限管理',
                'no_groups' => '没有权限组',
                'no_permissions' => '不允许选择',
                'no_roles' => '没有设置角色',
                'no_ungrouped' => '没有分组权限',

                'table' => [
                    'dependencies' => '依赖',
                    'group' => '权限组',
                    'group-sort' => '排序',
                    'name' => '名称',
                    'permission' => '权限节点',
                    'roles' => '角色',
                    'system' => '系统',
                    'total' => '许可总数|许可总数',
                    'users' => '用户',
                ],

                'tabs' => [
                    'general' => '常规',
                    'groups' => '权限组',
                    'dependencies' => '依赖',
                    'permissions' => '权限列表',
                ],

                'ungrouped_permissions' => '失去权限',
            ],

            'roles' => [
                'create' => '创建角色',
                'edit' => '编辑角色',
                'management' => '角色管理',
                'list' => '列表',

                'table' => [
                    'number_of_users' => '用户数',
                    'permissions' => '权限',
                    'role' => '角色',
                    'sort' => '排序',
                    'total' => '共计 :total 条记录',
                ],
            ],

            'users' => [
                'active' => '活动用户',
                'all_permissions' => '所有权限',
                'change_password' => '更换密码',
                'change_password_for' => '用户 :user 更换密码',
                'create' => '创建用户',
                'deactivated' => '禁用用户列表',
                'deleted' => '软删除用户列表',
                'dependencies' => '依赖',
                'edit' => '编辑用户',
                'management' => '用户管理',
                'no_other_permissions' => '没有其他权限',
                'no_permissions' => '没有权限',
                'no_roles' => '没有设置角色',
                'permissions' => '权限',
                'permission_check' => '检查权限也将同时检查它的依赖关系',

                'table' => [
                    'confirmed' => '认证',
                    'created' => '创建',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => '最后更新',
                    'name' => '用户名',
                    'no_deactivated' => '没有禁用用户',
                    'no_deleted' => '没有软删除用户',
                    'other_permissions' => '其他权限',
                    'attr' => '属性',
                    'roles' => '角色',
                    'total' => '共计 :total 条记录',
                ],
                'list' => '用户列表'
            ],

        ],
        'loop' => [
            'main' => '圈子管理',
            'info' => '圈子信息',
            'list' => '圈子列表',
            'owner' => '圈主',
            'msg' => '消息管理',
            'msg-list' => '消息列表',
            'tags' => '类别管理',
            'tags_list' => '类别列表',
            'authorith' => '权限管理',
            'authorith_list' => '权限列表',
            'table' => [
                'id' => 'ID',
                'sort' => '排序',
                'title'=> '圈子名称',
                'username' => '圈主',
                'users' => '用户数量',
                'diaries' => '日记数量',
                'last_msg_time' => '最后消息时间',
                'liveness' => '活跃度',
                'tags_title' => '类别名称',
                'created' => '创建时间',
                'loops' => '圈子数量',
                'authority_icon' => '图标',
                'authority_title' => '权限名称',
                'path' => '路由',
                'types' => '类型'
            ]
        ],
        'goods' => [
            'main' => '商品管理',
            'list' => '商品列表',
            'look' => '商品审核',
            'look_list' => '待审列表',
            'search' => [
                'list' => '商品搜索列表'
            ]
        ],
        'orders' => [
            'main' => '订单管理',
            'list' => '订单列表',
            'details' => '订单详情'
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title' => '登录',
            'login_button' => '登录',
            'login_with' => '登录 :social_media',
            'register_box_title' => '注册',
            'register_button' => '注册',
            'remember_me' => '记住我',
        ],

        'passwords' => [
            'forgot_password' => '忘记密码？',
            'reset_password_box_title' => '重置密码',
            'reset_password_button' => '重置密码',
            'send_password_reset_link_button' => '发送链接',
            'goback' => '返回'
        ],

        'macros' => [
            'country' => [
                'alpha' => 'Country Alpha Codes',
                'alpha2' => 'Country Alpha 2 Codes',
                'alpha3' => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us' => [
                    'us' => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed' => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => '更改密码',
            ],

            'profile' => [
                'avatar' => '头像',
                'created_at' => '创建时间',
                'edit_information' => '编辑信息',
                'email' => 'E-mail',
                'last_updated' => '最后更新时间',
                'name' => '名称',
                'update_information' => '更新信息',
            ],
        ],

    ],
];
