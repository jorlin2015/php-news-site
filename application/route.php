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
    'logout' => ['login/out', ['method' => 'get']],
    'more/:current' => ['index/more', ['method' => 'get']],
    'index/:current'   => ['index/index', ['method' => 'get']],
    'detail/:current/:id' => ['index/detail',['method' => 'get'], ['id' => '\d+']],
    'splider/[:name]/[:limit]/[:start]' => ['pictures/index', ['method' => 'get']]
];
