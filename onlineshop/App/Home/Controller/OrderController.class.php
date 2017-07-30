<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/30
 * Time: 16:03
 */
namespace Home\Controller;
use Home\Controller\HomeController;
use Org\Util\Date;

/*订单控制器*/
class OrderController extends HomeController{

    /*订单列表*/
    public function orderlist(){
        $order = D('Order');
        $info = $order->where(array('user_id'=>$_SESSION['user_id']))->select();
        foreach ($info as $k=>$v){
            $info[$k][] = D('Address')->field(array('name'))->where(array('address_id'=>$v['address_id']))->find()['name'];
        }
        $this->assign('info',$info);
        $this->display();
    }

    /*删除订单*/
    public function del(){
        $order_id = I('get.order_id');
        $z = D('Order')->where(array('order_id'=>$order_id))->delete();
        if ($z){
            $this->success('删除成功',U('orderlist'),1);
        }else{
            $this->error('删除失败',U('orderlist'),1);
        }
    }

    /*取消订单*/
    public function cancel(){
        $order_id = I('get.order_id');
        $z = D('Order')->where(array('order_id'=>$order_id))->save(array('order_status'=>4));
        if (!($z === false)){
            $this->success('取消订单成功',U('orderlist'),1);
        }else{
            $this->error('取消订单失败',U('orderlist'),1);
        }
    }


}





