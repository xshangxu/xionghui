<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/30
 * Time: 11:51
 */
namespace Home\Controller;
use Home\Controller\HomeController;

/* 购物车控制器 */
class CartController extends HomeController{

    /*购物车中商品列表*/
    public function cartlist(){
        $cart = D('Cart');
        $info = $cart->where(array('user_id'=>$_SESSION['user_id'],'cart_status'=>0))->select();
        $this->assign('info',$info);
        $this->display();
    }

    /*确认订单信息*/
    public function affirmorder(){
        $cart = D('Cart');
        if ($_POST){
            $data = $cart->create($_POST);
            $data['cart_status'] = 1;
            $z = $cart->save($data);
            if (!($z === false)){
                echo json_encode(array('status'=>1,'mean'=>'修改购物车状态成功','url'=>U('affirmorder')));
            }else{
                echo json_encode(array('status'=>2,'mean'=>'修改购物车状态失败','url'=>U('cartlist')));
            }
        }else{
            $info = $cart->where(array('user_id'=>$_SESSION['user_id'],'cart_status'=>1))->select(); //获取确认商品信息
            $attrinfo = D('Address')->where(array('user_id'=>$_SESSION['user_id']))->select(); //获取用户地址信息
            $this->assign('attrinfo',$attrinfo);
            $this->assign('info',$info);
            $this->display();
        }
    }


    /*订单提交成功*/
    public function ordersuccess(){
        $cart = D('Cart');
        if ($_POST){
            //将数据存入订单表中
            $data = $cart->field(array('user_id','goods_img','goods_id','price_total'))->where(array('cart_id'=>$_POST['cart_id']))->find();
            $data['address_id'] = $_POST['address_id'];
            $data['order_time'] = time();
            $data['goods_amount'] = $data['price_total'];
            $z = D('Order')->add($data);
            //删除购物车表中对应的数据
            $cart->where(array('cart_id'=>$_POST['cart_id']))->delete();
            if ($z){
                echo json_encode(array('status'=>1,'mean'=>'订单提交成功','url'=>U('ordersuccess')));
            }else{
                echo json_encode(array('status'=>2,'mean'=>'订单提交失败','url'=>U('affirmorder')));
            }
        }else{
            $this->display();
        }
    }

    //加入购物车ajax请求处理
    public function addCart(){
        $cart = D('Cart');
        if ($_POST){
            $data = $cart->create();
            $data['goods_id'] = $_POST['goods_id'];
            $data['goods_img'] = $_POST['goods_thumb'];
            $data['goods_number'] = $_POST['amount'];
            $data['goods_price'] = $_POST['shop_price'];
            $data['price_total'] = $_POST['shop_price'] * $_POST['amount'];
            $data['goods_attr'] = implode(' ',$_POST['attr_name']);
            $z = $cart->add($data);
            if ($z){
                echo json_encode($data);
            }else{
                echo json_encode(array('status'=>2,'mean'=>'添加失败'));
            }
        }
    }

    /*删除购物车数据*/
    public function del(){
        $cart_id = I('get.cart_id');
        $z = D('Cart')->where(array('cart_id'=>$cart_id))->delete();
        if ($z){
            $this->success('删除成功',U('cartlist'));
        }else{
            $this->error('删除失败',U('cartlist'));
        }
    }

}



