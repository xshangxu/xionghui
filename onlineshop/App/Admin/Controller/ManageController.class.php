<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 21:47
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Think;

//后台管理员控制器
class ManageController extends BaseController{
    //登入后台页面
    public function login(){
        //两个逻辑 收集表单数据，展示登录页面
        if (!empty($_POST)){
            //检验验证码是否正确
            $vrf = new \Think\Verify();
            if ($vrf->check($_POST['captcha'])){
                //验证码正确 检验用户名和密码
                $manage = D('manager');
                if ($manage->where(array('mg_name'=>$_POST['username']))->find() ||
                    $manage->where(array('mg_pwd'=>md5($_POST['password'])))->find()){
                    $info = $manage->where(array('mg_name'=>$_POST['username'],'mg_pwd'=>md5($_POST['password'])))->find();
                    if ($info){
                        //持久化session
                        session('mg_id',$info['mg_id']);
                        session('mg_name',$info['mg_name']);
                        echo json_encode(array('status'=>1,'mean'=>'登录成功','url'=>U('Index/index')));
                    }else{
                        echo json_encode(array('status'=>2,'mean'=>'账户或者密码不正确','url'=>U('login')));
                    }
                }else{
                    echo json_encode(array('status'=>3,'mean'=>'账号不存在,请先注册','url'=>U('login')));
                }
            }else{
                //验证码错误
                echo json_encode(array('status'=>4,'mean'=>'验证码不正确','url'=>U('login'),$_SESSION));
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

    //后台注册页面
    public function register(){
        $this->display();
    }

    //生成验证码
    public function verifyImg(){
        $cfg = array(
            'fontSize'  =>  14,              // 验证码字体大小(px)
            'imageH'    =>  30,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        //实例化verifyImg类
        $very = new \Think\Verify($cfg);
        //生成验证码
        $very->entry();
    }

    function checkLogin(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == 'admin' && $password == 'admin'){
            echo json_encode(array('status'=>1,'url'=>U('Index/index'),'success'=>'登入成功'));
        }else{
            echo json_encode(array('status'=>2,'url'=>U('Manage/login'),'fail'=>'登入失败'));
        }

    }

    //ajax过来校验验证码
    function checkCode(){
        $code = $_POST['captcha']; //获得用户输入的验证码
        $vry = new \Think\Verify();
        if($vry -> check($code)){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>2));
        }
    }

}




