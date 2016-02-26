<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'permissions' => [
                'edit_explanation' => '如果在左侧层次结构中执行操作请刷新本页面',

                'groups' => [
                    'hierarchy_saved' => '层次保存成功',
                ],

                'sort_explanation' => '将权限分组管理，以便可以分配一组权限给用户',
            ],

            'users' => [
                'delete_user_confirm' => 'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error. Proceed at your own risk. This can not be un-done.',
                'if_confirmed_off' => '(If confirmed is off)',
                'restore_user_confirm' => 'Restore this user to its original state?',
            ],
        ],

        'dashboard' => [
            'title' => '后台管理首页',
            'welcome' => 'Welcome',
            'hello'=>'hello,'
        ],

        'general' => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure' => 'Are you sure?',
            'boilerplate_link' => 'Laravel 5 Boilerplate',
            'version'=> 'Version 1.0.0',
            'copyright'=>'ETOUP',
            'continue' => 'Continue',
            'member_since' => 'Member since',
            'search_placeholder' => '搜索...',

            'see_all' => [
                'messages' => '更多消息',
                'notifications' => '更多提醒',
                'tasks' => '更多任务',
            ],

            'status' => [
                'online' => '在线管理',
                'offline' => '离线管理',
            ],

            'you_have' => [
                'messages' => '{0} 没有消息|{1} 您有 1 条消息|[2,Inf] 您有 :number 条消息',
                'notifications' => '{0} 没有提醒信息|{1} 您有 1 条提醒|[2,Inf] 您有 :number 条提醒',
                'tasks' => '{0} 没有任务|{1} 您有 1 件任务|[2,Inf] 您有 :number 件任务',
            ],

        ],

        'links' => [
            'account'=>'账户',
            'integral'=>'积分',
            'message'=>'消息'

        ]
    ],

    'emails' => [
        'auth' => [
            'password_reset_subject' => 'Your Password Reset Link',
            'reset_password' => 'Click here to reset your password',
        ],
    ],

    'frontend' => [
        'email' => [
            'confirm_account' => 'Click here to confirm your account:',
        ],

        'test' => 'Test',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role' => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'user' => [
            'profile_updated' => 'Profile successfully updated.',
            'password_updated' => 'Password successfully updated.',
        ],

        'welcome_to' => 'Welcome to :place',
    ],
];