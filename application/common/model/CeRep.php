<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 10:40
 */

namespace app\common\model;

use think\Model;

class CeRep extends Model
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
        $res = $this->allowField(true)->validate("CeRep.add")->save($data);

        return $res;
    }
}