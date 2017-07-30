<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4
 * Time: 11:29
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Admin\Model\UserModel;

/*用户控制器*/
class UserController extends BaseController{

    /*用户列表*/
    public function showlist(){
        $user = new UserModel();
        $newInfo = $user->fetchPage();
        $info = $newInfo['pageinfo'];  //每页显示数据
        $pagelist = $newInfo['pagelist'];  //页码
        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }

    /*添加用户*/
    public function append(){
        $user = D('User');
        if ($_POST){
            if ($_POST['user_pwd'] == $_POST['pwd_again']){
                $data = $user->create($_POST);
                $data['user_pwd'] = md5($data['user_pwd']);
                $z = $user->add($data);
                if ($z){
                    $this->success('添加用户成功',U('showlist'),1);
                }else{
                    $this->error('添加用户失败',U('append'),1);
                }
            }else{
                $this->error('您输入的密码不一致',U('append'),1);
            }
        }else{
            $this->display();
        }
    }

    /*修改用户信息*/
    public function upd(){
   /*     $user = D('User');
        $user_id = I('get.user_id');
        if ($_POST){
            if ($_POST['user_pwd'] == $_POST['pwd_again']){
                $data = $user->create($_POST);
                $z = $user->save($data);
                if (!($z === false)){
                    $this->success('修改用户信息成功',U('showlist'),1);
                }else{
//                    $this->error('修改用户信息失败',U('upd',array('user_id'=>$user_id)),1);
                }
            }else{
                $this->error('您输入的密码不一致',U('upd',array('user_id'=>$user_id)),1);
            }
        }else{
            $info = $user->where(array('user_id'=>$user_id))->find();
            $this->assign('info',$info);
            $this->display();
        }*/
        $this->display();
    }

    /*删除用户*/
    public function del(){
        $z = D('User')->where(array('user_id'=>I('get.user_id')))->delete();
        if ($z){
            $this->success('删除成功',U('showlist'),1);
        }else{
            $this->error('删除成功',U('showlist'),1);
        }
    }

}





