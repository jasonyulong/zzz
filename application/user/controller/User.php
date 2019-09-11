<?php
namespace app\user\controller;

use app\common\controller\User as Usercontr;

class User extends Usercontr
{
    public function face(){
        if($this->request->isPost()){
            $data=input('post.');

            //文件上传
            $file = $this->request->file('face');
            if(!empty($file)){
                //图片有问题
                $image = \think\Image::open($file->getPathname());
                if($image->width()<50||$image->height()<50){
                    $this->success("修改成功!", url("user/user/face"),'',1);
                }
                $oldpicurl='.'.db('Member')->where(array('id'=>$this->userinfo['id']))->value('face');
                $file->validate(['size' =>1024*1024*2, 'ext' => 'jpg,png,gif']);   //2M
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/memberface');
                if ($info) {
                    $data['face'] = '/uploads/memberface/' . $info->getSaveName();
                    if(strlen($oldpicurl)>3&&file_exists($oldpicurl)) unlink($oldpicurl);
                } else {
                    $this->error($file->getError());
                }
            }

            db('Member')->where(array('id'=>$this->userinfo['id']))->update(array('face'=>$data['face']));
            $this->success("修改成功", url("user/user/face"),'',1);
        }else{
            $this->assign("userinfo",$this->userinfo);
            return $this->fetch();
        }
    }
    public function repass()
    {
        if($this->request->isPost()){
            $data=input('post.');

            $validate = validate('Member');
            if(!$validate->scene('userrepass')->check($data)){
                $this->error($validate->getError());
            }

            $repwd=md5($data["password"]);
            db('Member')->where(array('id'=>$this->userinfo['id']))->update(array('password'=>$repwd));
            $this->success("修改成功", url("user/index/index"),'',1);
        }else{
            return $this->fetch();
        }
    }
}
