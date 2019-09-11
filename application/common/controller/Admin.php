<?php
/**
 * Created by PhpStorm.
 * User: sunwen
 * Date: 2018/3/19
 * Time: 16:11
 */
namespace app\common\controller;

use think\Controller;
use app\common\model\Admin as AdminModel;

Class Admin extends Controller
{

    public $userinfo;

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

        //是否登录
        $admin=new AdminModel();
        if(!$admin->cookiecheck()){
            $this->redirect('index/index/adminlogin');
            die();
        }
        $admin->updatelasttime(cookie('uid'));

        //基本信息
        $this->userinfo=db('admin')->where(array('id'=>cookie('uid')))->find();
        if(empty($this->userinfo['face'])) $this->userinfo['face']="/images/defaface.jpg";
        if($this->userinfo['issup']==1) $this->userinfo['role']="01,02,03,04,05,06,07";
        $this->userinfo['roleary']=explode(",",$this->userinfo['role']);

        $this->assign("userinfo",$this->userinfo);
    }

}