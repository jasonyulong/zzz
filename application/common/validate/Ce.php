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
class Ce extends Validate{
    protected $rule =   [
        'name'  => 'require|max:24',
        'des'  => 'max:800',
    ];
    protected $message  =   [
        'name.require' => '名称必须填写',
        'name.max'     => '名称最多不能超过24个字符',
        'des.max'     => '简介最多不能超过800个字符',
    ];
    protected $scene = [
        'add'  =>  ['name','des'],
        'edit'  =>  ['name','des'],
    ];
}