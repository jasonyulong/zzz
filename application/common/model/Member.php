<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class Member extends Model
{
    function del($id){
        $result=$this->where(array('id'=>$id))->delete();
        return $result;
    }
    function add($data){
        $data['password']=md5($data['password']);
        $data['state']=1;
        $data['regtime']=time();
        $data['lasttime']=time();
        $data['token']=md5(time());
        $data['getpwd']='';
        $data['face']='/images/defaface.jpg';
        if(empty($data['phone'])) $data['phone']='';
        unset($data['password2']);
        $res = $this->save($data);
        return $res;
    }
    function login($data){
        $data['password']=md5($data['password']);
        $info = $this->where($data)->find();
        if($info){
            if($info['state']==1){
                cookie('member_uid',$info['id'], 864000);
                cookie('member_username',$info['username'], 864000);

                $this->updatetoken($info['id']);
                cookie('member_token',$this->where($data)->value('token'), 864000);

                return $info['id'];
            }elseif($info['state']==0){
                return 0;
            }else{
                return -1;
            }
        }else{
            return -1;
        }
    }
    function logout(){
        cookie(null, 'qzw_');
    }
    function updatetoken($id){
        $token=md5($id.date("m/d"));
        $this->where(array('id'=>$id))->update(array('token'=>$token));
    }
    function updatelasttime($id){
        $this->where(array('id'=>$id))->update(array('lasttime'=>time()));
    }
    function cookiecheck(){
        $info=$this->where(array('username'=>cookie('member_username'),'token'=>cookie('member_token'),'state'=>1))->find();
        if(isset($info)&&$info['id']>0){
            return true;
        }else{
            return false;
        }
    }
}