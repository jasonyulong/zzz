<?php
namespace app\index\controller;

use app\common\controller\Defa;
use app\common\model\CeRep;
use think\Request;
use think\response\Json;

class Anli extends Defa
{
    public function index(){
        $list=db('Ce')->order('id desc')->paginate(9,false,['query'=>request()->param()]);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function info(){
        if($this->request->isPost()){
            $data=input('post.');
            $mod=new CeRep();
            $result=$mod->add($data);
            if($result){
                echo("<script language=\"javascript\">alert('评论成功，等待审核');</script>");
            }else{
                echo("<script language=\"javascript\">alert('评论失败：".$mod->getError()."');</script>");
            }
            $this->success("", url('index/anli/info',['id'=>$data['ce_id']]),'',0);
        }
        $id = input('id', '', 'trim,intval');
        $info = db('Ce')->where(array('id' => $id))->find();
        if(empty($info)) to_404();

        $info["saysum"]=db("CeRep")->where(array("ce_id"=>$id,"view"=>1))->count();
        $info["cangsum"]=db("Cang")->where(array("type"=>"case","toid"=>$id))->count();

        $info["l"]=str_replace(array("\r\n", "\r", "\n"), "<br>", $info["l"]);
        $this->assign("info", $info);

        $hotlist = db('Ce')->where("zan>0")->limit(8)->select();
        $this->assign("hotlist", $hotlist);
        return $this->fetch();
    }
    // /index/anli/info_json_cang.html
    public function info_json_cang(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $toid = input('id');
        //$toid=3;

        if(!empty($toid)){
            if($this->islogin){
                $isfind=db("Cang")->where(array("toid"=>$toid,"member_id"=>cookie('member_uid'),"type"=>"case"))->find();
                if(empty($isfind)){
                    $result["return"]=1;
                    db("Cang")->insert(array("toid"=>$toid,"member_id"=>cookie('member_uid'),"type"=>"case"));
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
    // /index/anli/info_json_cang.html
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
                    db("Ce")->where(array("id"=>$id))->setInc("zan");
                }
                if($type=="delete"){
                    db("Ce")->where(array("id"=>$id))->setDec("zan");
                }
                db("Ce")->where("zan<0")->update(array("zan"=>0));
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
    // /index/anli/info_json_say.html
    public function info_json_say(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $page = input('page');
        //$id=4;
        //$page=1;

        if(empty($page)) $page=1;
        if(!empty($id)){
            $result["return"]=1;
            $res=array();

            $list=db('CeRep')->where(array("ce_id"=>$id,"view"=>1))->order('id desc')->paginate(3,false,['page'=>$page]);
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
    // /index/anli/info_json_repzan.html
    public function info_json_repzan(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $type = input('type');
        //$id=4;
        //$type="delete";

        if(!empty($id)){
            if($type=="add"){
                db("CeRep")->where(array("id"=>$id))->setInc("zan");
            }
            if($type=="delete"){
                db("CeRep")->where(array("id"=>$id))->setDec("zan");
            }
            db("CeRep")->where("zan<0")->update(array("zan"=>0));
            $result["return"]=1;
        }else{
            $result["err"]="ID不能为空";
        }

        $jmod=new Json($result);
        $jmod->send();
        die();
    }
}