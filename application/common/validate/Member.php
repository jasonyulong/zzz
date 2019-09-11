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
class Member extends Validate{
    protected $rule =   [
        'username'  => 'unique:member|alphaNum|max:12|min:4',
        'password'  => 'require|min:4|max:12',
        'password2'  => 'require|confirm:password',
        'phone'  => 'require|regex:/^1[34578]{1}\d{9}$/',
        'email'  => 'require|email',
    ];
    protected $message  =   [
        'username.max'     => '用户名不能超过12个字符',
        'username.min'     => '用户名不能少于4个字符',
        'username.alphaNum'     => '用户名必须为字母或数字',
        'username.unique'     => '存在重复用户名',
        'password.require'     => '密码不能为空',
        'password.min'     => '密码不能少于4个字符',
        'password.max'     => '密码不能超过12个字符',
        'password2.confirm'     => '二次密码输入不一致',
        'password2.require'     => '密码不能为空',
        'phone.require'     => '手机不能为空',
        'phone.regex'     => '手机格式错误',
        'email.require'     => '邮箱不能为空',
        'email.email'     => '邮箱格式错误',
    ];
    protected $scene = [
        'add'  =>  ['username','password','password2','email'],
        'edit_pwd'  =>  ['password','password2','phone'],
        'userrepass'  =>  ['password','password2'],
        'getpwd'  =>  ['email'],
        'getpwdset'  =>   ['password','password2'],
    ];
}