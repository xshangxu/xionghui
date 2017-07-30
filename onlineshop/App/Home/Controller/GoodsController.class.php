<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/29
 * Time: 17:24
 */
namespace Home\Controller;
use Home\Controller\HomeController;

/* 前台商品控制器 */
class GoodsController extends HomeController{

    /*商品列表*/
    public function goodslist(){
        $cat_id = I('get.cat_id');
        $infoType = D('Category')->order('cat_id')->select();
        $info = D('Goods')->where(array('cat_id'=>$cat_id))->select();
        $this->assign('info',$info);
        $this->assign('infoType',$infoType);
        $this->display();
    }

    /*商品详情*/
    public function details(){
        $goods_id = I('get.goods_id'); //get获取商品编号
        $info = D('Goods')->where(array('goods_id'=>$goods_id))->find(); //获取商品信息
        $picsInfo = D('Galary')->order('img_id')->where(array('goods_id'=>$goods_id))->select(); //获取商品相册信息
        /*对商品表信息处理*/
        $info['add_time'] = date('Y-m-d',$info['add_time']);
        $info['goods_desc'] = nl2br($info['goods_desc']); //将分行符"\r\n"转义成HTML的换行符"<br />"
        $info['goods_desc'] = explode('<br />',$info['goods_desc']); //"<br />"作为分隔切成数组
        $this->assign('info',$info);
        $this->assign('newPic',$picsInfo);
        $this->display();
    }

}
