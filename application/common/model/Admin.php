<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class Admin extends Model
{
    function del($id){
        $result=$this->where(array('id'=>$id))->delete();
        return $result;
    }
    function add($data){
        if(!empty($data['role'])){
            foreach($data['role'] as $k=>$v){
                $rolelist[]=$k;
            }
        }
        $rolestr='';
        if(!empty($rolelist)) $rolestr=implode($rolelist,',');
        $data['role']=$rolestr;

        $data['password']=md5($data['password']);
        if(!is_numeric($data['state'])) $data['state']=1;
        $data['regtime']=time();
        $data['lasttime']=time();
        $data['issup']=0;
        $data['token']=md5(time());
		$data['face']='';
        $data['nickname']=$data['username'];
        unset($data['password2']);
        $res = $this->save($data);
        return $res;
    }
    function login($data){
        $data['password']=md5($data['password']);
        $info = $this->where($data)->find();
        if($info){
            if($info['state']==1){
                cookie('uid',$info['id'], 864000);
                cookie('username',$info['username'], 864000);

                $this->updatetoken($info['id']);
                cookie('token',$this->where($data)->value('token'), 864000);

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
        $info=$this->where(array('username'=>cookie('username'),'token'=>cookie('token'),'state'=>1))->find();
        if(isset($info)&&$info['id']>0){
            return true;
        }else{
            return false;
        }
    }
}