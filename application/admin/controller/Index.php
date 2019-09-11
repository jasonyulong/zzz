<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\common\model\Admin as AdminModel;

class Index extends Admin
{
    public function index()
    {
        $set=db('set')->where(array('tp'=>'set'))->value('des');
        $setinfo=unserialize($set);
        $this->assign("setinfo",$setinfo);

        return $this->fetch();
    }
    public function home(){
        if(!cache('member_all')){
            $member_all=db('Member')->count();
            cache('member_all',$member_all,3600*12);
        }else{
            $member_all=cache('member_all');
        }
        $this->assign('member_all',$member_all);

        if(!cache('article_all')){
            $article_all=db('Article')->count();
            cache('article_all',$article_all,3600*12);
        }else{
            $article_all=cache('article_all');
        }
        $this->assign('article_all',$article_all);

        if(!cache('link_sum')){
            $link_sum=db('Link')->count();
            cache('link_sum',$link_sum,3600*12);
        }else{
            $link_sum=cache('link_sum');
        }
        $this->assign('link_sum',$link_sum);

        if(!cache('zhaopin_sum')){
            $zhaopin_sum=db('Zhaopin')->count();
            cache('zhaopin_sum',$zhaopin_sum,3600*12);
        }else{
            $zhaopin_sum=cache('zhaopin_sum');
        }
        $this->assign('zhaopin_sum',$zhaopin_sum);

        $artlist=db('Article')->order('look desc')->limit(10)->select();
        $this->assign('artlist',$artlist);

        $artlist=db('Article')->order('id desc')->limit(5)->select();
        $this->assign('hotlist',$artlist);

        return $this->fetch();
    }
    public function logout(){
        $admin=new AdminModel();
        $admin->logout();
        $this->redirect('index/index/adminlogin');
    }
}