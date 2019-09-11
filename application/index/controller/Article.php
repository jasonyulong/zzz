<?php
namespace app\index\controller;

use app\common\controller\Defa;
use app\common\model\Article as ArticleModel;
use app\common\model\ArticleRep;
use think\response\Json;

class Article extends Defa
{

    public function ln(){
        return $this->fetch();
    }
    public function xm(){
        $pics=db("Article")->where(array("sort"=>10,"pic"=>array('NEQ','')))->limit(3)->order("id desc")->select();
        for($i=0;$i<count($pics);$i++){
            $pics[$i]["title"] = mb_substr($pics[$i]['title'], 0, 15, 'utf-8');

            $pics[$i]["content"]=remove_html($pics[$i]["content"]);
            $pics[$i]["content"] = mb_substr($pics[$i]['content'], 0, 500, 'utf-8');
        }
        $this->assign("pics",$pics);

        $list=db('Article')->where(array("sort"=>10))->order('id desc')->paginate(5,false,['query'=>request()->param()]);
        $list->each((function($item, $key){
            $item["content"]=remove_html($item["content"]);
            $item["content"] = mb_substr($item['content'], 0, 200, 'utf-8');
            return $item;
        }));
        $this->assign("list",$list);

        return $this->fetch();
    }

    public function zh(){
        $one=db("Article")->where(array("sort"=>7))->select();
        for($i=0;$i<count($one);$i++){
            $one[$i]["content"]=remove_html($one[$i]["content"]);
        }
        $two=db("Article")->where(array("sort"=>8))->select();
        for($i=0;$i<count($two);$i++){
            $two[$i]["content"]=remove_html($two[$i]["content"]);
        }
        $this->assign("one",$one);
        $this->assign("two",$two);
        return $this->fetch();
    }

    public function index(){
		$id = input('id', '', 'trim,intval');
		$where=array();
		if($id>0){
			$where["sort"]=$id;
			$this->assign("id",$id);
		}else{
			$where["sort"]=array("in","13,14,15");
			$this->assign("id",0);
		}
		$where["pic"]=array('NEQ','');
        $list=db('Article')->where($where)->order('id desc')->paginate(10,false,['query'=>request()->param()]);
        $list->each((function($item, $key){
            $item["sortname"]=db("Sort")->where(array("id"=>$item["sort"]))->value("name");
            $item["content"]=remove_html($item["content"]);
            $item["content"] = mb_substr($item['content'], 0, 300, 'utf-8');
            return $item;
        }));
        $this->assign("list",$list);
        return $this->fetch();
    }
    // /index/article/index_json/page/1.html
    public function index_json(){
        header("Access-Control-Allow-Origin: *");

        $sort=input("sort");

        //where
        $order="id desc";
        $where=array();
        if(!empty($sort)) $where["sort"]=$sort;

        $page=input('page', '', 'trim,intval');
        $mod=new \app\common\model\Article();
        $list=$mod->showlist(array("where"=>$where,"order"=>$order),4,$page);
        $list=$list->toArray();
        foreach($list["data"] as &$v){
            if(empty($v["pic"])){
                $v["pic"]="/images/pg/images/icons/hotnews%20(1).png";
            }
            unset($v["content"]);
        }
        $jmod=new Json($list["data"]);
        $jmod->send();
        die();
    }
    public function info()
    {
        $mod=new ArticleModel();
        $id = input('id', '', 'trim,intval');
        $info = db('Article')->where(array('id' => $id))->find();
        if(empty($info)) to_404();
        $info['title_share']=str_replace(PHP_EOL,'',strip_tags($info['title']));
        $info['des']=str_replace(PHP_EOL,'',strip_tags(mb_substr(strip_tags($info['content']),0,20,'utf-8')));
        $info['description']=mb_substr(strip_tags($info['content']),0,100,'utf-8');
        $info['time']=date("Y-m-d",$info['time']);
        $info['sortinfo']=db('Sort')->where(array('id'=>$info['sort']))->find();
        $this->assign("info", $info);

        $updown=$mod->getUpDown($id,$info['sort']);
        $this->assign("updown", $updown);

        $tuilist=db("Article")->where(array("pic"=>array('NEQ','')))->limit(6)->order('rand()')->select();
        $this->assign("tuilist",$tuilist);

        return $this->fetch();
    }
    // /index/article/info_json_cang.html
    public function info_json_cang(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $toid = input('id');
        //$toid=10;

        if(!empty($toid)){
            if($this->islogin){
                $isfind=db("Cang")->where(array("toid"=>$toid,"member_id"=>cookie('member_uid'),"type"=>"article"))->find();
                if(empty($isfind)){
                    $result["return"]=1;
                    db("Cang")->insert(array("toid"=>$toid,"member_id"=>cookie('member_uid'),"type"=>"article"));
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
    // /index/article/info_json_zan.html
    public function info_json_zan(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $type = input('type');
        //$id=10;
        //$type="add";

        if(!empty($id)){
            if($this->islogin){
                if($type=="add"){
                    db("Article")->where(array("id"=>$id))->setInc("zan");
                }
                if($type=="delete"){
                    db("Article")->where(array("id"=>$id))->setDec("zan");
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
    // /index/article/info_json_say.html
    public function info_json_say(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $page = input('page');
        //$id=10;
        //$page=1;

        if(empty($page)) $page=1;
        if(!empty($id)){
            $result["return"]=1;
            $res=array();

            $list=db('ArticleRep')->where(array("article_id"=>$id,"view"=>1))->order('id desc')->paginate(3,false,['page'=>$page]);
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
    // /index/article/info_json_repzan.html
    public function info_json_repzan(){
        header("Access-Control-Allow-Origin: *");
        $result=array("return"=>0,"err"=>"");
        $id = input('id');
        $type = input('type');
        //$id=10;
        //$type="add";

        if(!empty($id)){
            if($type=="add"){
                db("ArticleRep")->where(array("id"=>$id))->setInc("zan");
            }
            if($type=="delete"){
                db("ArticleRep")->where(array("id"=>$id))->setDec("zan");
            }
            db("ArticleRep")->where("zan<0")->update(array("zan"=>0));
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
        db('Article')->where(array('id'=>$id))->setInc('look');
        die();
    }
}
