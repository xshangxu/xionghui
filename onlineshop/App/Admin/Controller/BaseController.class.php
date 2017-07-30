<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 0:00
 */
namespace Admin\Controller;
use Think\Controller;

//基础控制器
class BaseController extends Controller{
    /*构造函数*/
    function __construct(){
        parent::__construct(); //先执行父类的构造方法
        $mg_name = $_SESSION['mg_name'];
//        echo $mg_name;
        if (!empty($mg_name)){ //登录状态
            /*获取权限信息在后台页面左侧栏显示*/
            $auth_infoA = D('Auth')->where("auth_level=0")->select();//顶级权限
            $auth_infoB = D('Auth')->where("auth_level=1")->select();//次顶级权限
            $this->assign('auth_infoA',$auth_infoA);
            $this->assign('auth_infoB',$auth_infoB);
        }else{ //退出系统状态
//            $this->redirect('/Admin/Manage/login');
        }
    }

}

