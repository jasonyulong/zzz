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
        'name' => '\w+',
    ],
    '__alias__' =>  [
        'about'  =>  'index/index',
    ],
    'a'=>'index/index/adminlogin',
    'userlogin'=>'index/index/userlogin',

    'business'=>'index/article/zh',
    'news'=>'index/article/index',
    'new/:id'=>'index/article/info',
    'responsibility'=>'index/article/ln',
    'welfare'=>'index/article/xm',
];