<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 10:40
 */

namespace app\common\model;

use think\Model;

class Da extends Model
{
    function add($data){
        $data['sort']='0';
        $res = $this->save($data);
        return $res;
    }
    function del($id){
        $oldpicurl='.'.$this->where(array('id'=>$id))->value('pic');
        if(strlen($oldpicurl)>3&&file_exists($oldpicurl)) unlink($oldpicurl);

        $this->where(array('id'=>$id))->delete();
        return 1;
    }
}