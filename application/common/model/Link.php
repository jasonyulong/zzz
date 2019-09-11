<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 10:40
 */

namespace app\common\model;

use think\Model;

class Link extends Model
{
    function add($data){
        $data['pic']='';
        $data['sort']='0';
        $res = $this->save($data);
        return $res;
    }
    function del($id){
        $this->where(array('id'=>$id))->delete();
        return 1;
    }
}