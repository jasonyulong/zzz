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
class Da extends Validate{
    protected $rule =   [
        'title'  => 'require|max:24',
        'url'  => 'require|max:48',
        'sort'  => 'number',
    ];
    protected $message  =   [
        'title.require' => '标题必须填写',
        'title.max'     => '标题最多不能超过12个字符',
        'url.require' => '链接必须填写',
        'url.max'     => '链接最多不能超过48个字符',
        'sort.number'     => '排序只能填写数字',
    ];
    protected $scene = [
        'add'  =>  ['title','url','sort'],
        'edit'  =>  ['title','url','sort'],
    ];
}