<?php
namespace app\index\controller;

use app\common\controller\Defa;
use app\common\model\ProRep;
use think\response\Json;

class Pro extends Defa
{
    public function index(){
        $sort=input("sort");
        if($sort=="hot"){
            $hot="hot";
            $sort=0;
        }
        $jsonurl="";

        //ID选择
        if(!empty($hot)) $indexid="dayi_".$hot;
        if(empty($hot)) $indexid="dayi_new";
        if(!empty($sort)) $indexid="dayi_".$sort;
        $this->assign("indexid",$indexid);

        //where
        $order="id desc";
        $where=array();
        if(!empty($hot)){
            $order="look desc";
            $jsonurl=url("index/pro/index_json","type=hot&page=nowpage");
        }
        if(!empty($sort)){
            $where["sort"]=$sort;
            $jsonurl=url("index/pro/index_json","sort=".$sort."&page=nowpage");
        }

        if(empty($jsonurl)) $jsonurl=url("index/pro/index_json","page=nowpage");

        $this->assign("jsonurl",str_replace("nowpage.html","",$jsonurl));

        $mod=new \app\common\model\Pro();
        $list=$mod->showlist(array("where"=>$where,"order"=>$order),8);
        $this->assign("list",$list);
        $this->assign("listcount",$list->total());

        $sortlist=db("ProSort")->order("id asc")->select();
        $this->assign("sortlist",$sortlist);

        $hotlist=db("Pro")->where("look>=0")->limit(10)->order('rand()')->select();
        $this->assign("hotlist",$hotlist);

        return $this->fetch();
    }
    // /index/pro/index_json/page/1.html
    public function index_json(){
        header("Access-Control-Allow-Origin: *");

        $hot=input("type");
        $sort=input("sort");

        //where
        $order="id desc";
        $where=array();
        if(!empty($hot)) $order="look desc";
        if(!empty($sort)) $where["sort"]=$sort;

        $page=input('page', '', 'trim,intval');
        $mod=new \app\common\model\Pro();
        $list=$mod->showlist(array("where"=>$where,"order"=>$order),4,$page);
        $list=$list->toArray();

        $jmod=new Json($list["data"]);
        $jmod->send();
        die();
    }

    public function info(){
        if($this->request->isPost()){
            $data=input('post.');
            $mod=new ProRep();
            $result=$mod->add($data);
            if($result){
                echo("<script language=\"javascript\">alert('评论成功，等待审核');</script>");
            }else{
                echo("<script language=\"javascript\">alert('评论失败：".$mod->getError()."');</script>");
            }
            $this->success("", url('index/pro/info',['id'=>$data['pro_id']]),'',0);
        }
        $id = input('id', '', 'trim,intval');
        $mod=new \app\common\model\Pro();
        $info=$mod->info($id,array("limit"=>1,"page"=>1),array("limit"=>1,"page"=>1));
        if(empty($info)) to_404();
        $this->assign("info",$info);

        $hotlist=db("Pro")->where("look>=0")->limit(10)->order('rand()')->select();
        $this->assign("hotlist",$hotlist);

        $sortlist=db("Pro")->where(array("sort"=>$info["sort"]))->limit(5)->order('rand()')->select();

        $mod=new \app\common\model\Pro();
        $sortlist=$mod->showlist(array("where"=>array("sort"=>$info["sort"]),"order"=>"id desc"),5);
        $this->assign("sortlist",$sortlist);

        return $this->fetch();
    }
    // /index/pro/info_json_cang.html
    public function info_json_cang(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $toid = input('id');
        //$toid=3;

        if(!empty($toid)){
            if($this->islogin){
                $isfind=db("Cang")->where(array("toid"=>$toid,"member_id"=>cookie('member_uid'),"type"=>"pro"))->find();
                if(empty($isfind)){
                    $result["return"]=1;
                    db("Cang")->insert(array("toid"=>$toid,"member_id"=>cookie('member_uid'),"type"=>"pro"));
                }else{
                    $result["err"]="不能重复收藏";
                }
            }else{
                $result["return"]=0;
                $result["err"]="您还没有登录";
            }
        }else{
            $result["err"]="ID不能为空";
        }

        $jmod=new Json($result);
        $jmod->send();
        die();
    }
    // /index/pro/info_json_cang.html
    public function info_json_zan(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $type = input('type');
        //$id=14;
        //$type="add";

        if(!empty($id)){
            if($this->islogin){
                if($type=="add"){
                    db("Ans")->where(array("pro_id"=>$id))->setInc("zan");
                }
                if($type=="delete"){
                    db("Ans")->where(array("pro_id"=>$id))->setDec("zan");
                }
                db("Ans")->where("zan<0")->update(array("zan"=>0));
                $result["return"]=1;
            }else{
                $result["return"]=0;
                $result["err"]="您还没有登录";
            }
        }else{
            $result["err"]="ID不能为空";
        }

        $jmod=new Json($result);
        $jmod->send();
        die();
    }
    // /index/pro/info_json_say.html
    public function info_json_say(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $page = input('page');
        //$id=14;
        //$page=1;

        if(empty($page)) $page=1;
        if(!empty($id)){
            $result["return"]=1;
            $res=array();

            $list=db('ProRep')->where(array("pro_id"=>$id,"view"=>1))->order('id desc')->paginate(3,false,['page'=>$page]);
            $list->each((function($item, $key){
                $item["time_ch"]=time_ago($item["time"]);
                if($item["member_id"]>0){
                    $memberinfo=db("Member")->where(array("id"=>$item["member_id"]))->find();
                    if($memberinfo){
                        $item['re_name']=$memberinfo["username"];
                        $item['re_face']=$memberinfo["face"];
                    }else{
                        $item['re_name']="匿名";
                        $item['re_face']="/images/defaface.jpg";
                    }
                }
                if($item["member_id"]==0){
                    $item['re_name']="游客";
                    $item['re_face']="/images/defaface.jpg";
                }
                return $item;
            }));
            $res=$list->toArray();
            $result["list"]=$res["data"];
        }else{
            $result["err"]="ID不能为空";
        }

        $jmod=new Json($result);
        $jmod->send();
        die();
    }
    // /index/pro/info_json_repzan.html
    public function info_json_repzan(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $type = input('type');
        //$id=4;
        //$type="delete";

        if(!empty($id)){
            if($type=="add"){
                db("ProRep")->where(array("id"=>$id))->setInc("zan");
            }
            if($type=="delete"){
                db("ProRep")->where(array("id"=>$id))->setDec("zan");
            }
            db("ProRep")->where("zan<0")->update(array("zan"=>0));
            $result["return"]=1;
        }else{
            $result["err"]="ID不能为空";
        }

        $jmod=new Json($result);
        $jmod->send();
        die();
    }

    public function look(){
        $id=input('id');
        db('Pro')->where(array('id'=>$id))->setInc('look');
        die();
    }
}