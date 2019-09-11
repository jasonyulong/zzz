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
class Article extends Validate{
    protected $rule =   [
        'title'  => 'require|max:40',
        'content'  => 'require',
    ];
    protected $message  =   [
        'title.require' => '标题必须填写',
        'title.max'     => '标题最多不能超过40个字符',
        'content.require' => '内容必须填写',
    ];
    protected $scene = [
        'add'  =>  ['title'],
        'edit'  =>  ['title'],
    ];
}