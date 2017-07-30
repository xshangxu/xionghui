<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 16:20
 */
namespace Home\Controller;
use Home\Controller\HomeController;

//用户控制器
class UserController extends HomeController{
    //登录系统
    public function login(){
        $user = D('User');
        if ($_POST){
            //检验验证码是否正确
            $vrf = new \Think\Verify();
            if ($vrf->check($_POST['checkcode'])){
                //验证码正确
                $data = $user->create($_POST);
                if ($user->where(array('user_name'=>$_POST['user_name']))->find() ||
                    $user->where(array('user_pwd'=>md5($_POST['user_pwd'])))->find()){
                    $info = $user->where(array('user_name'=>$_POST['user_name'],'user_pwd'=>md5($_POST['user_pwd'])))->find();
                    if ($info){
                        //持久化session
                        session('user_id',$info['user_id']);
                        session('user_name',$info['user_name']);
                        echo json_encode(array('status'=>1,'mean'=>'*登录成功','url'=>U('Index/index'),'user_id'=>$info['user_id'],'user_name'=>$info['user_name']));
                    }else{
                        echo json_encode(array('status'=>2,'mean'=>'*账户或者密码不正确','url'=>U('login')));
                    }
                }else{
                    echo json_encode(array('status'=>3,'mean'=>'*账号不存在,请先注册','url'=>U('login')));
                }
            }else{
                //验证码错误
                echo json_encode(array('status'=>4,'mean'=>'*验证码不正确','url'=>U('login')));
            }
        }else{
            $this->display();
        }
    }

    /*退出系统*/
    public function logout(){
        session(null); //清空session
        $this -> redirect('login'); //页面跳转到登录页
    }

    //注册账户
    public function register(){
        $user = D('User');
        if ($_POST){
            //检验验证码是否正确
            $vrf = new \Think\Verify();
            if ($vrf->check($_POST['checkcode'])){
                $data = $user->create();
                $data['user_pwd'] = md5($data['user_pwd']);
                $z = $user->add($data);
                if ($z){
                    echo json_encode(array('status'=>1,'mean'=>'注册成功','url'=>U('login')));
                }else{
                    echo json_encode(array('status'=>2,'mean'=>'注册失败','url'=>U('register')));
                }
            }else{
                echo json_encode(array('status'=>3,'mean'=>'验证码错误','url'=>U('register')));
            }
        }else{
            $this->display();
        }
    }

    //生成验证码
    public function verifyImg(){
        $cfg = array(
            //'fontSize'  =>  14,              // 验证码字体大小(px)
            //'imageH'    =>  30,               // 验证码图片高度
            //'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        //实例化verifyImg类
        $very = new \Think\Verify($cfg);
        //生成验证码
        $very->entry();
    }

    //检查用户输入的验证码是否正确
    public function checkCode(){
        $code = I('get.checkCode'); //获得用户输入的验证码
        $vry = new \Think\Verify();
        if($vry -> check($code)){
            echo json_encode(array('status'=>1,'mean'=>'正确'));
        }else{
            echo json_encode(array('status'=>2,'mean'=>'错误'));
        }
    }

    /*展示用户信息*/
    public function userinfo(){
        $info = D('User')->where(array('user_id'=>$_SESSION['user_id']))->find();
        $this->assign('info',$info);
        $this->display();
    }

    /*修改用户信息*/
    public function upduserinfo(){
        $user = D('User');
        if ($_POST){
            $user_pwd = $user->field('user_pwd')->where(array('user_id'=>$_SESSION['user_id']))->find()['user_pwd'];
            //判断密码是否正确
            if (md5($_POST['user_pwd']) == $user_pwd){
                $data = $user->create();
                $data['user_pwd'] = md5($data['user_pwd']);
                $z = $user->where(array('user_id'=>$_SESSION['user_id']))->save($data);
                if (!($z === false)){
                    echo json_encode(array('status'=>1,'mean'=>'修改信息成功','url'=>U('userinfo')));
                }else{
                    echo json_encode(array('status'=>2,'mean'=>'修改信息失败','url'=>U('upduserinfo')));
                }
            }else{
                echo json_encode(array('status'=>3,'mean'=>'*密码不正确'));
            }
        }else{
            $info = $user->where(array('user_id'=>$_SESSION['user_id']))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

}