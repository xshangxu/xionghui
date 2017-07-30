<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/2
 * Time: 16:56
 */
namespace Home\Controller;
use Think\Controller;

/*前台基础控制器*/
class HomeController extends Controller{

    //构造函数
    function __construct(){
        parent::__construct();

        /******获取分类信息，给模板展示*****/
        $category = D('Category');
        //根据等级 分别获取
        $cat_infoA = $category->where(array('cat_level'=>0))->select();
        $cat_infoB = $category->where(array('cat_level'=>1))->select();
        $cat_infoC = $category->where(array('cat_level'=>2))->select();
        $this -> assign('cat_infoA',$cat_infoA);
        $this -> assign('cat_infoB',$cat_infoB);
        $this -> assign('cat_infoC',$cat_infoC);
        /******获取分类信息，给模板展示*****/

        /******获取购物车信息，右侧栏展示展示*****/
        $cart = D('Cart');
        $cartInfo = $cart->where(array('user_id'=>$_SESSION['user_id'],'cart_status'=>0))->select();
        $this -> assign('cartInfo',$cartInfo);
        /******获取购物车信息，右侧栏展示展示*****/
    }


}



