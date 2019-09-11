<?php
namespace app\index\controller;

use app\common\controller\Defa;
use app\common\model\Admin as AdminModel;
use app\common\model\Member as MemberModel;

class Index extends Defa
{
    public function index()
    {
        $bannerlist=db("Da")->where(array("cate"=>"首页banner"))->order("id desc")->select();
        $this->assign("bannerlist",$bannerlist);

        $hotart=db("Article")->where(array("sort"=>5))->order("id desc")->limit(4)->select();
        for($i=0;$i<count($hotart);$i++){
            $hotart[$i]["content"]=strip_tags($hotart[$i]["content"]);
        }
        $this->assign("hotart",$hotart);

        $zr=db("Article")->where(array("sort"=>11))->order("id desc")->find();
        $zr["content"]=strip_tags($zr["content"]);
        $this->assign("zr",$zr);

        return $this->fetch();
    }
    public function search(){
        $key=input("key");
        $this->redirect("http://www.sogou.com/web?q=$key&query=$key+site:http://www.i35tax.com/&fieldtitle=&fieldcontent=&fieldstripurl=&bstype=&ie=utf8&sitequery=http://www.i35tax.com/&located=0&tro=off&num=10",302);
        die();
    }
    public function getpwd(){
        if ($this->request->isPost()) {
            $data=input('post.');
            $isfind=db("Member")->where($data)->find();
            if(!empty($isfind)){
                $this->success("load", url("index/index/getpwdset","getpwd=".$data["getpwd"]),'',0);
            }else{
                $this->error("验证信息错误");
            }
            print_r($data);
        }else{
            return $this->fetch();
        }
    }
    public function getpwd_mail(){
        $username=input('username');
        $email=input('email');
        $list=db("Member")->where(array('username'=>$username,'email'=>$email))->select();
        if(empty($list)) die("账号或邮件错误");
        $rnd=date("Ymd").rand(0000,9999);
        foreach($list as $v){
            db('Member')->where(array('id'=>$v['id']))->update(array('getpwd'=>$rnd));
        }
        die("密码找回邮件已经发送");
    }
    public function getpwdset(){
        if ($this->request->isPost()) {
            $data=input('post.');
            $validate = validate('Member');
            if(!$validate->scene('getpwdset')->check($data)){
                $this->error($validate->getError());
            }

            $getpwd=$data['getpwd'];
            if(empty($getpwd)) $this->error("邮箱验证码错误");
            $isfind=db('Member')->where(array('getpwd'=>$getpwd))->find();
            if(empty($isfind)) $this->error("邮箱验证码错误");

            db('Member')->where(array('getpwd'=>$getpwd))->update(array('password'=>md5($data['password']),'getpwd'=>''));
            $this->success("操作成功", url("index/index/index"),'',1);
        }else{
            $this->assign("getpwd",input("getpwd"));
            return $this->fetch();
        }
    }
    public function adminlogin(){
        $mod = new AdminModel;
        if ($this->request->isPost()) {
            $result=$mod->login(input('post.'));
            if($result>0){
                $this->success("登录成功", url("admin/index/index"),'',1);
            }elseif($result==0){
                $this->error("账号被禁用");
            }elseif($result==-1){
                $this->error("账号或密码错误");
            }
        }else{
            if($mod->cookiecheck()){
                $this->redirect('admin/index/index');
            }
            return $this->fetch();
        }
    }
    public function userlogin(){
        $mod = new MemberModel;
        if ($this->request->isPost()) {
            $data=input('post.');

            $result=$mod->login($data);
            if($result>0){
                $this->success("登录成功", url("user/index/index"),'',1);
            }elseif($result==0){
                $this->error("账号被禁用");
            }elseif($result==-1){
                $this->error("账号或密码错误");
            }
        }else{
            if($mod->cookiecheck()){
                $this->redirect('user/index/index');
            }
            return $this->fetch();
        }
    }
    public function userregister(){
        if($this->request->isPost()) {
            $data=input('post.');

            //if(!captcha_check($data['captcha'])) $this->error("验证码错误");
            //unset($data['captcha']);

            $validate = validate('Member');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }

            $mod=new MemberModel();
            $mod->add($data);

            $last=db('member')->where(array('username'=>$data['username']))->find();
            if(!empty($last['id'])&&$last['id']>0){
                $result=$mod->login(array('username'=>$data['username'],'password'=>$data['password']));
                if($result>0){
                    $this->success("注册成功", url("user/index/index"),'',1);
                }elseif($result==0){
                    $this->error("账号被禁用");
                }elseif($result==-1){
                    $this->error("账号或密码错误");
                }
            }else{
                $this->error("注册失败");
            }
        }else{
            return $this->fetch();
        }
    }
    public function culture(){
        return $this->fetch();
    }
    public function about(){
        return $this->fetch();
    }
    public function beijing(){
        return $this->fetch();
    }
    public function wuhan(){
        return $this->fetch();
    }
    public function shenzheng(){
        return $this->fetch();
    }
    public function shanxi(){
        return $this->fetch();
    }
    public function map(){
        return $this->fetch();
    }
    public function about_ci(){
        return $this->fetch();
    }
    public function about_structure(){
        return $this->fetch();
    }
    public function about_structure_show(){
        return $this->fetch();
    }
    public function about_strategy(){
        return $this->fetch();
    }
    public function job(){
        $list=db("Zhaopin")->order("id desc")->select();
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function us(){
        return $this->fetch();
    }
    public function idea(){
        return $this->fetch();
    }
    public function staff(){
        $list=db("Article")->where(array("sort"=>18))->order("hot desc,id desc")->limit(24)->select();
        $this->assign("list",$list);
        return $this->fetch();
    }
}
