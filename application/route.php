<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'current' => '\w+',
    ],
    'login' => ['login/index', ['method' => 'post|get']],
    'logout' => ['login/out', ['method' => 'post|get']],
    'register' => ['login/register', ['method' => 'post|get']],
    'index/getMessage' => ['index/getMessage', ['method' => 'get']],
    'index/getContacts' => ['index/getContacts', ['method' => 'get']],
    'index/getRoomMember' => ['index/getRoomMember', ['method' => 'get']],
    'index/toBeFriend' => ['index/toBeFriend', ['method' => 'post']],
    'history' => ['history/index', ['method' => 'get']],
    'history/getMessage' => ['history/getMessage', ['method' => 'get']]
];
