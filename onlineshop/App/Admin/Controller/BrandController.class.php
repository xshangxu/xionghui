<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28
 * Time: 10:45
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Admin\Model\BrandModel;

/*商品品牌控制器*/
class BrandController extends BaseController{

    /*品牌列表*/
    public function showlist(){
        $brand = new BrandModel();
        $newinfo = $brand->fetchPage();
        $info = $newinfo['pageinfo'];     //每页显示数据
        $pagelist = $newinfo['pagelist']; //页码列表

        $this->assign('pagelist',$pagelist);
        $this->assign('info',$info);
        $this->display();
    }

    /*添加品牌*/
    public function append(){
        $brand = new BrandModel();
        //收集  展示
        if ($_POST){
//            dump($_FILES);
//            dump($_POST);
//            exit();
            $data = $brand->create();
            $z = $brand->add($data);
            if ($z){
                $this->success('添加品牌成功',U('showlist'),1);
            }else{
                $this->error('添加品牌失败',U('append'),1);
            }
        }else{
            $this->display();
        }
    }

    /*修改品牌*/
    public function upd(){
        $brand = new BrandModel();
        $brand_id = I('get.brand_id');
        if ($_POST){
            $data = $brand->create($_POST);
            $data['brand_id'] = $brand_id;
            $z = $brand->save($data);
            if (!($z === false)){
                $this->success('修改品牌成功',U('showlist'),1);
            }else{
                $this->error('修改品牌失败',U('upd',array('brand_id'=>$brand_id)),1);
            }
        }else{
            $info = $brand->where(array('brand_id'=>$brand_id))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*删除品牌*/
    public function del(){
        $brand_id = I('brand_id');
        $z = D('Brand')->where(array('brand_id'=>$brand_id))->delete();
        if ($z){
            $this->success('删除品牌成功',U('showlist'),1);
        }else{
            $this->error('删除品牌失败',U('showlist'),1);
        }
    }

}





