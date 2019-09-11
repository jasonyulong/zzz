<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 9:35
 */

namespace app\common\validate;

use think\Validate;
/**
 * 设置模型
 */
class Sort extends Validate{
    protected $rule =   [
        'name'  => 'require|max:12',
    ];
    protected $message  =   [
        'name.require' => '名称必须填写',
        'name.max'     => '名称最多不能超过12个字符',
    ];
    protected $scene = [
        'add'  =>  ['name'],
        'edit'  =>  ['name'],
    ];
}