<?php
/**
 * Created by PhpStorm.
 * User: sunwen
 * Date: 2018/3/19
 * Time: 16:11
 */
namespace app\common\controller;

use think\Controller;
use app\common\model\Member as MemberModel;

Class User extends Controller
{

    public $userinfo;

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

        //是否登录
        $member=new MemberModel();
        if(!$member->cookiecheck()){
            $this->redirect('index/index/userlogin');
            die();
        }
        $member->updatelasttime(cookie('member_uid'));

        //基本信息
        $this->userinfo=db('member')->where(array('id'=>cookie('member_uid')))->find();
        $this->assign("userinfo",$this->userinfo);

        $link=db('Link')->order('id desc')->limit(8)->select();
        $this->assign("link",$link);

        $count=db('set')->where(array('tp'=>'index'))->value('des');
        $count=unserialize($count);
        $this->assign("count",$count);
    }
}