<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'permissions' => [
            'created' => '成功创建权限',
            'deleted' => '成功删除权限',

            'groups'  => [
                'created' => '成功创建权限组',
                'deleted' => '成功删除权限组',
                'updated' => '权限组更新成功',
            ],

            'updated' => '权限节点更新成功',
        ],

        'roles' => [
            'created' => '成功创建角色',
            'deleted' => '成功删除角色',
            'updated' => '成功更新角色',
        ],

        'users' => [
            'confirmation_email' => '新的确认邮件已经成功发送',
            'created' => '用户创建成功',
            'deleted' => '用户删除成功',
            'deleted_permanently' => '用户被永久删除',
            'restored' => '用户已成功恢复',
            'updated' => '用户信息成功更新',
            'updated_password' => "用户密码成功更新",
            'edit-business-ok' => '成功操作商家信息'
        ],

        'loop' => [
            'created' => '成功创建圈子',
            'update' => '成功更新圈子',
            'tags' => [
                'created' => '成功创建圈子类别',
                'updated' => '成功更新圈子类别',
                'destroy' => '成功删除圈子类别'
            ],
            'authority' => [
                'created' => '成功创建圈子权限',
                'updated' => '成功更新圈子权限',
                'destroy' => '成功删除圈子权限'
            ],
            'cancel-top-ok' => '成功取消置顶',
            'do-top-ok' => '成功置顶',
            'destroy-ok' => '成功删除圈子',
            'msg-destroy-ok' => '成功删除消息'
        ],
        'goods' => [
            'do-down-ok' => '成功下架商品',
            'destroy-ok' => '成功删除商品',
            'store-ok' => '成功编辑商品',
            'look-ok' => '商品成功通过审核',
            'look-no' => '商品未通过审核',
            'do-look-no' => '成功处理商品未通过审核',
        ],
        'orders' => [
            'destroy-ok' => '成功删除订单',
            'store-ok' => '成功编辑订单',
        ]
    ],
];