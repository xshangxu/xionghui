<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/25
 * Time: 15:28
 */
namespace Admin\Controller;
use Admin\Model\AuthModel;
use Admin\Controller\BaseController;

/*权限控制器*/
class AuthController extends BaseController{

    //权限列表展示
    public function showlist(){
        $info = D('Auth')->order('auth_path')->select();
        $this->assign('info',$info);
        $this->display();
    }

    //添加权限
    public function append(){
        $auth = new AuthModel();
        //两个逻辑  展示 收集
        if ($_POST){
            $data = $auth->create();
            $z = $auth->add($data);
            if ($z){
                $this->success('添加权限成功',U('showlist'),2);
            }else{
                $this->error('添加权限失败',U('append'),2);
            }
        }else{
            $pinfo = $auth->field(array("auth_id","auth_name","auth_level"))->order('auth_path')->select();
            $this->assign('pinfo',$pinfo);
            $this->display();
        }
    }

    //删除权限
    public function del(){
        if ($_GET){
            $z = D('auth')->where(array('auth_id'=>$_GET['auth_id']))->delete();
            if ($z){
                $this->success('删除成功',U('showlist'),2);
            }else{
                $this->error('删除失败',U('showlist'),2);
            }
        }
    }

    /*修改权限*/
    public function upd(){
        $auth = new AuthModel();
        //两个逻辑  展示 修改
        if ($_POST){
            $data = $auth->create();
            $data['auth_id'] = $_GET['auth_id'];
            $z = $auth->save($data);

            //对auth表的auth_path和auth_level进行维护
            if($data['auth_pid'] == 0){
                $auth_path = $data['auth_id'];
            }else{
                $pinfo = $auth ->field('auth_path')->find($data['auth_pid']); //获得父级全路径
                $path = $pinfo['auth_path'];
                $auth_path = $path."-".$data['auth_id'];
            }
            $level = substr_count($auth_path,'-');  // 计算$auth_path中“-”的个数
            $auth -> save(array('auth_id'=>$data['auth_id'],'auth_path'=>$auth_path,'auth_level'=>$level));
            if (!($z === false)){
                $this->success('修改权限成功',U('showlist'),2);
            }else{
                $this->error('修改权限失败',U('upd',array('auth_id'=>$_GET['auth_id'])),2);
            }
        }else{
            $info = $auth->where(array('auth_id'=>$_GET['auth_id']))->find();
            $this->assign('info',$info);
            $pinfo = $auth->field(array("auth_id","auth_name","auth_level"))->order('auth_path')->select();
            $this->assign('pinfo',$pinfo);
            $this->display();
        }
    }


}















