<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 10:40
 */

namespace app\common\model;

use think\Model;

class ArticleRep extends Model
{
    function add($data){
        $data['time']=time();
        $data['zan']=0;
        $data['view']=0;
        if(!empty(cookie("member_uid"))){
            $data["member_id"]=cookie("member_uid");
        }else{
            $data["member_id"]=0;
        }
        $res = $this->allowField(true)->validate("ArticleRep.add")->save($data);

        $this->update_rep_sum($data["article_id"]);
        return $res;
    }
    function del($id){
        $this->where(array('id'=>$id))->delete();
        $this->update_rep_sum($id);
        return 1;
    }
    function update_rep_sum($article_id){
        $sum=$this->where(array('article_id'=>$article_id))->count();
        db("Article")->where(array('id'=>$article_id))->update(array("rep_sum"=>$sum));
    }
}