<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/29
 * Time: 11:04
 */

namespace app\admin\controller;

use app\common\controller\Admin;

class User extends Admin
{
    public function info(){
        if($this->request->isPost()){
            $data=input('post.');

            //文件上传
            $file = $this->request->file('face');
            if(!empty($file)){
                $oldpicurl='.'.db('Admin')->where(array('id'=>$this->userinfo['id']))->value('face');
                $file->validate(['size' =>1024*1024*2, 'ext' => 'jpg,png,gif']);   //2M
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/adminface');
                if ($info) {
                    $data['face'] = '/uploads/adminface/' . $info->getSaveName();
                    if(strlen($oldpicurl)>3&&file_exists($oldpicurl)) unlink($oldpicurl);

                    db('Admin')->where(array('id'=>$this->userinfo['id']))->update(array('face'=>$data['face']));
                } else {
                    $this->error($file->getError());
                }
            }

            $data=input('post.');
            $mod=new \app\common\model\Admin();
            $result=$mod->validate("Admin.edit_info")->allowField(true)->isUpdate()->save($data);
            $this->success("修改成功", url("admin/user/info"),'',0);
        }else{
            $info=db('Admin')->where(array('id'=>$this->userinfo['id']))->find();
            $this->assign("info",$info);
            return $this->fetch();
        }
    }
    public function repwd()
    {
        if($this->request->isPost()){
            $data=input('post.');
            $validate = validate('Admin');
            if(!$validate->scene('edit_pwd')->check($data)){
                $this->error($validate->getError());
            }
            db('Admin')->where(array('id'=>$this->userinfo['id']))->update(array('password'=>md5($data['password'])));
            $this->success("修改成功", url("admin/user/repwd"),'',0);
        }else{
            return $this->fetch();
        }
    }
}