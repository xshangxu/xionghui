<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 10:31
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Admin\Model\AttributeModel;

/*属性控制器*/
class AttributeController extends BaseController{

    /*属性列表*/
    public function showlist(){
        $attribute = new AttributeModel();
        $type_id = $_GET['type_id'];
        if ($_GET){
            $info = $attribute->where(array('type_id'=>$type_id))->order('type_id')->select();
        }else{
            $info = $attribute->order('type_id')->select();
        }
        $typeinfo = D('GoodsType')->select();
        $count = count($info);
        $newinfo = $attribute->fetchPage($count,$type_id);
        $info = $newinfo['pageinfo'];
        $pagelist = $newinfo['pagelist'];

        //将type_name 添加入$info中
        $i = 0;
        foreach ($info as $value){
            $typename = D('GoodsType')->where(array('type_id'=>$value['type_id']))->find();
            $info[$i]['type_name'] = $typename['type_name'];
            $i++;
        }

        $this->assign('typeinfo',$typeinfo);
        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }

    /*添加商品属性*/
    public function append(){
        $attribute = new AttributeModel();
        //展示 收集
        if ($_POST){
            $data = $attribute->create($_POST);
            if ($data){
                $z = $attribute->add($data);
                if ($z){
                    $this->success('添加属性成功',U('Type/showlist'),1);
                }else{
                    $this->error("添加属性失败",U('append'),1);
                }
            }else{
                //验证失败
                $errorinfo = $attribute->getError();
                $this->error($errorinfo,U('append'),1);
            }
        }else{
            $typeinfo = D('GoodsType')->select();
            $this->assign('typeinfo',$typeinfo);
            $this->display();
        }
    }

    /*修改商品属性*/
    public function upd(){
        $attribute = new AttributeModel();
        $attr_id = I('get.attr_id');
        if ($_POST){
            $data = $attribute->create($_POST);
            $data['attr_id'] = $attr_id;
            if ($data){
                $z = $attribute->save($data);
                if (!($z === false)){
                    $this->success('修改属性成功',U('showlist',array('type_id'=>$data['type_id'])),1);
                }else{
                    $this->error('修改属性失败',U('upd',array('attr_id'=>$attr_id)),1);
                }
            }else{
                //验证失败
                $errorinfo = $attribute->getError();
                $this->error($errorinfo,U('upd',array('attr_id'=>$attr_id)),1);
            }
        }else{
            $typeinfo = D('GoodsType')->select();
            $info = $attribute->where(array('attr_id'=>$attr_id))->find();
            $this->assign('typeinfo',$typeinfo);
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*删除商品属性*/
    public function del(){
        $info = D('Attribute')->where(array('attr_id'=>$_GET['attr_id']))->find();
        $z = D('Attribute')->where(array('attr_id'=>$_GET['attr_id']))->delete();
        if ($z){
            $this->success('删除属性成功',U('showlist',array('type_id'=>$info['type_id'])),1);
        }else{
            $this->error('删除属性失败',U('showlist'),1);
        }
    }

    /*根据type_id获得相应的属性*/
    public function getAttr(){
        $attribute = new AttributeModel();
        $type_id = I('get.type_id');
        if ($type_id == 0){
            $info = D('Attribute')->order('type_id')->select();
        }else{
            $info = D('Attribute')->where(array('type_id'=>$type_id))->select();
        }
        $count = count($info);
        $newinfo = $attribute->fetchPage($count,$type_id);
        echo json_encode($newinfo);
    }

}


