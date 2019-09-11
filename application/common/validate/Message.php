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
class Message extends Validate{
    protected $rule =   [
        'title'  => 'require|max:40',
        'name'  => 'require|max:20',
        'tel'  => 'require|max:16',
        'sex'  => 'require|max:8',
        'content'  => 'max:500',
    ];
    protected $message  =   [
        'title.require' => '标题必须填写',
        'title.max'     => '标题最多不能超过40个字符',
        'name.require' => '姓名必须填写',
        'name.max'     => '姓名最多不能超过20个字符',
        'tel.require' => '电话必须填写',
        'tel.max'     => '电话最多不能超过16个字符',
        'sex.require' => '性别必须填写',
        'sex.max'     => '性别最多不能超过8个字符',
        'content.max'     => '内容最多不能超过500个字符',
    ];
    protected $scene = [
        'add'  =>  ['title','name','tel','sex','content'],
    ];
}