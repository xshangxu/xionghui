<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 23:39
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Admin\Model\CategoryModel;

/*商品分类控制器*/
class CategoryController extends BaseController{

    /*分类列表*/
    public function showlist(){
        $cstegory = new CategoryModel();
        $newinfo = $cstegory->fetchPage();
        $info =  $newinfo['pageinfo'];
        $pagelist = $newinfo['pagelist'];
        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }

    /*添加分类*/
    public function append(){
        $category = new CategoryModel();
        if ($_POST){
            $data = $category->create();
            $z = $category->add($data);
            if ($z){
                $this->success('添加分类成功',U('showlist'),1);
            }else{
                $this->error('添加分类失败',U('append'),1);
            }
        }else{
            $pinfo = $category->field(array("cat_id","cat_name","cat_level"))->order('cat_path')->select();
            $this->assign('pinfo',$pinfo);
            $this->display();
        }
    }

    /*修改分类*/
    public function upd(){
        $category = new CategoryModel();
        //两个逻辑  展示 修改
        if ($_POST){
            $data = $category->create();
            $data['cat_id'] = $_GET['cat_id'];
            $z = $category->save($data);

            //对cat表的cat_path和cat_level进行维护
            if($data['cat_pid'] == 0){
                $cat_path = $data['cat_id'];
            }else{
                $pinfo = $category ->field('cat_path')->find($data['cat_pid']); //获得父级全路径
                $path = $pinfo['cat_path'];
                $cat_path = $path."-".$data['cat_id'];
            }
            $level = substr_count($cat_path,'-');  // 计算$cat_path中“-”的个数
            $category -> save(array('cat_id'=>$data['cat_id'],'cat_path'=>$cat_path,'cat_level'=>$level));
            if (!($z === false)){
                $this->success('修改分类成功',U('showlist'),2);
            }else{
                $this->error('修改分类失败',U('upd',array('cat_id'=>$_GET['cat_id'])),2);
            }
        }else{
            $info = $category->where(array('cat_id'=>$_GET['cat_id']))->find();
            $this->assign('info',$info);
            $pinfo = $category->order('cat_path')->select();
            $this->assign('pinfo',$pinfo);
            $this->display();
        }
    }

    /*删除分类*/
    public function del(){
        if ($_GET){
            $z = D('Category')->where(array('cat_id'=>$_GET['cat_id']))->delete();
            if ($z){
                $this->success('删除成功',U('showlist'),1);
            }else{
                $this->error('删除失败',U('showlist'),1);
            }
        }
    }

}




