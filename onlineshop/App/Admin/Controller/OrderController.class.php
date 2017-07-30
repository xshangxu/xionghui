<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/1
 * Time: 10:18
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Admin\Model\OrderModel;

/*订单控制器*/
class OrderController extends BaseController{

    /*订单列表*/
    public function showlist(){
        $order = new OrderModel();
        $newInfo = $order->fetchPage();
        $info = $newInfo['pageinfo'];     //每页显示数据
        $pagelist = $newInfo['pagelist']; //页面
        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }

    /*添加订单*/
    public function append(){
        $this->display();
    }

    /*修改订单*/
    public function upd(){
        $this->display();
    }

    /*删除订单*/
    public function del(){
        $order_id = I('get.order_id');
        $z = D('Order')->where(array('order_id'=>$order_id))->delete();
        if ($z){
            $this->success('删除成功',U('showlist'),1);
        }else{
            $this->error('删除失败',U('showlist'),1);
        }
    }






}






