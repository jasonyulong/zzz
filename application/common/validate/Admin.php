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
class Admin extends Validate{
    protected $rule =   [
        'username'  => 'unique:admin|alphaNum|max:12|min:4',
        'password'  => 'require|max:12',
        'password2'  => 'require|confirm:password',
        'nickname'  => 'require|max:12',
    ];
    protected $message  =   [
        'username.max'     => '用户名不能超过12个字符',
        'username.min'     => '用户名不能少于4个字符',
        'username.alphaNum'     => '用户名必须为字母或数字',
        'username.unique'     => '存在重复用户名',
        'password.require'     => '密码不能为空',
        'password.max'     => '密码不能超过12个字符',
        'password2.confirm'     => '二次密码输入不一致',
        'password2.require'     => '密码不能为空',
        'nickname.require'     => '昵称不能为空',
        'nickname.max'     => '昵称不能超过12个字符',
    ];
    protected $scene = [
        'add'  =>  ['username','password','password2'],
        'edit_pwd'  =>  ['password','password2'],
        'edit_info'  =>  ['nickname'],
    ];
    //'password.check_username_fu'     => '请不要使用相同的账号密码',
    protected function check_username_fu($value,$rule,$data){
        if($data['password']==$data['username']){
            return false;
        }else{
            return true;
        }
    }
}