<?php
namespace app\user\controller;

use app\common\controller\User;
use app\common\model\Member as MemberModel;

class Cang extends User
{
    public function article()
    {
        $list=db('Cang')->field("a.*,b.id as bid,b.title,b.time,b.pic")->alias("a")->join("Article b","a.toid=b.id")->where(array("type"=>"article","member_id"=>$this->userinfo["id"]))->order('a.id desc')->paginate(10,false,['query'=>request()->param()]);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function ycase()
    {
        $list=db('Cang')->field("a.*,b.id as bid,b.name,b.pic")->alias("a")->join("Ce b","a.toid=b.id")->where(array("type"=>"case","member_id"=>$this->userinfo["id"]))->order('a.id desc')->paginate(10,false,['query'=>request()->param()]);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function ypro()
    {
        $idp=array();
        $idp[]=0;
        $ids=db("Cang")->where(array("type"=>"pro","member_id"=>$this->userinfo["id"]))->select();
        if(!empty($ids)){
            foreach($ids as $v){
                $idp[]=$v["toid"];
            }
        }

        $mod=new \app\common\model\Pro();
        $list=$mod->showlist(array("where"=>array("id"=>array("in",implode(",",$idp))),"order"=>"id desc"),8,input("page"));
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function del(){
        $id=input('id', '', 'trim,intval');
        db("Cang")->where(array("id"=>$id,"member_id"=>$this->userinfo["id"]))->delete();
        $this->success("删除成功", url("user/cang/index"),'',0);
    }
}