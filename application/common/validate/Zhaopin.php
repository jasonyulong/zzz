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
class Zhaopin extends Validate{
    protected $rule =   [
        'name'  => 'require|max:48',
        'num'  => 'require|number',
        'area'  => 'require',
        'des'  => 'require',
    ];
    protected $field = [
        'name'=> '职位名称',
        'num'=> '人数',
        'area'  => '地区',
        'des'  => '备注',
    ];
    protected $scene = [
        'add'  =>  ['name','num','area','des'],
        'edit'  =>  ['name','num','area','des'],
    ];
}