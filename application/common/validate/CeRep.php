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
class CeRep extends Validate{
    protected $rule =   [
        'content'  => 'require|max:300',
    ];
    protected $message  =   [
        'content.require' => '评论必须填写',
        'content.max'     => '评论最多不能超过300个字符',
    ];
    protected $scene = [
        'add'  =>  ['content'],
        'edit'  =>  ['content'],
    ];
}