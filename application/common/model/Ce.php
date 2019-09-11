<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 10:40
 */

namespace app\common\model;

use think\Model;

class Ce extends Model
{
    function add($data){
        $data['time']=time();
        $data['zan']=0;
        if(empty($data['pic'])) $data['pic']='';
        $res = $this->allowField(true)->validate("Ce.add")->save($data);
        return $res;
    }
    function del($id){
        $oldpicurl='.'.$this->where(array('id'=>$id))->value('pic');
        if(strlen($oldpicurl)>3&&file_exists($oldpicurl)) unlink($oldpicurl);

        db('CeRep')->where(array('ce_id'=>$id))->delete();

        $this->where(array('id'=>$id))->delete();
        return 1;
    }
}