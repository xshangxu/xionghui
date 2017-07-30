<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/30
 * Time: 17:39
 */
namespace Home\Controller;
use Home\Controller\HomeController;

/* 地址控制器 */
class AddressController extends HomeController{

    /*显示收货地址*/
    public function showaddress(){
        $info = D('Address')->where(array('user_id'=>$_SESSION['user_id']))->select();
        $this->assign('info',$info);
        $this->display();
    }

    /*修改收货地址*/
    public function updaddress(){
        $address = D('Address');
        $address_id = I('get.address_id');
        if ($_POST){
            $data = $address->create($_POST);
            $z = $address->save($data);
            if (!($z === false)){
                echo json_encode(array('status'=>1,'mean'=>'修改地址成功','url'=>U('showaddress')));
            }else{
                echo json_encode(array('status'=>2,'mean'=>'修改地址失败','url'=>U('updaddress',array('address_id'=>$data['address_id']))));
            }
        }else{
            $info = $address->where(array('address_id'=>$address_id))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*删除收货地址*/
    public function del(){
        $address_id = I('get.address_id');
        $z = D('Address')->where(array('address_id'=>$address_id))->delete();
        if ($z){
            $this->success('删除成功',U('showaddress'),1);
        }else{
            $this->error('删除失败',U('showaddress'),1);
        }
    }

    /*处理添加收货地址ajax请求*/
    public function add_address(){
        if ($_POST){
            $address = D('Address');
            $data = $address->create();
            $z = $address->add($data);
            if ($z){
                echo json_encode(array('status'=>1,'mean'=>'添加地址成功','url'=>U('showaddress')));
            }else{
                echo json_encode(array('status'=>2,'mean'=>'添加地址失败，再试一次','url'=>U('showaddress')));
            }
        }
    }

}


