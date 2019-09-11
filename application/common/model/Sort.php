<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 10:40
 */

namespace app\common\model;

use think\Model;

class Sort extends Model
{
    function add($data){
        $res = $this->save($data);
        return $res;
    }
    function del($id){
        $isfind=$this->where(array('pid'=>$id))->find();
        if($isfind){
            return -1;
        }
        $isart=db("Article")->where(array("sort"=>$id))->find();
        if(!empty($isart)){
            return -1;
        }
        $this->where(array('id'=>$id))->delete();
        return 1;
    }
}