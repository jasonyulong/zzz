<?php
namespace app\user\controller;

use app\common\controller\User;
use app\common\model\Member as MemberModel;
use app\common\model\Pro;

class Index extends User
{
    public function index()
    {
        $this->redirect(url("user/index/ask"),302);
    }
    public function logout(){
        $admin=new MemberModel();
        $admin->logout();
        $this->redirect('index/index/userlogin');
    }
    public function ask(){
        $mod=new \app\common\model\Pro();
        $list=$mod->showlist(array("where"=>array("member_id"=>$this->userinfo["id"]),"order"=>"id desc"),8,input("page"));
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function askadd(){
        if($this->request->isPost()){
            $data=input('post.');
            $mod=new Pro();
            $result=$mod->add($data);
            if($result !== false){
                $this->success("添加成功", url("user/index/ask"),'',0);
            }else{
                $this->error($mod->getError());
            }
        }else {
            $info = db('ProSort')->field('id,name,pid')->select();
            if (empty($info)) {
                $this->success("暂不能添加问题", url("user/index/ask"), '', 3);
            }

            $list = \ClassTree::hTree($info);
            $this->assign("list", $list);

            return $this->fetch();
        }
    }
}