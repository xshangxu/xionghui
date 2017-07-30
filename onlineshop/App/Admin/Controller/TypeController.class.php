<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 8:13
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Upload;

/*商品类型控制器*/
class TypeController extends BaseController{

    /*商品类型列表*/
    public function showlist(){
        $goodsType = D('GoodsType');
        /*商品类型分页*/
        $total = $goodsType->count();
        $per = 20;
        $page = new \Tools\Page($total,$per);
        $info = $goodsType->order('type_id')->limit($page->offset,$per)->select(); //当前页数据信息
        $pagelist = $page->fpage(array(3,4,5,6,7,8)); //页码列表
        $this->assign('pagelist',$pagelist);
        $this->assign('info',$info);
        $this->display();
    }

    /*修改商品类型*/
    public function upd(){
        $goodsType = D('GoodsType');
        if ($_POST){
            $data = $goodsType->create($_POST);
            $data['type_id'] = $_GET['type_id'];
            $z = $goodsType->save($data);
            if (!($z === false)){
                $this->success('修改类型成功',U('showlist'),2);
            }else{
                $this->error('修改类型失败',U('upd',array('type_id'=>$_GET['type_id'])),2);
            }
        }else{
            $info = $goodsType->where(array('type_id'=>$_GET['type_id']))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*删除商品类型*/
    public function del(){
        if ($_GET){
            $z = D('GoodsType')->where(array('type_id'=>$_GET['type_id']))->delete();
            if ($z){
                $this->success('删除商品类型成功',U('showlist'),2);
            }else{
                $this->error('删除商品类型失败',U('showlist'),2);
            }
        }
    }

    /*添加商品类型*/
    public function append(){
        $goodsType = D('GoodsType');
        if ($_POST){
            $data = $goodsType->create();
            $z = $goodsType->add($data);
            if ($z){
                $this->success('添加商品类型成功',U('showlist'),2);
            }else{
                $this->error('添加商品类型失败',U('upd'),2);
            }
        }else{
            $this->display();
        }
    }

}







