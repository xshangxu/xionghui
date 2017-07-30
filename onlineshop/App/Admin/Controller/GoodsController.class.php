<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/19
 * Time: 11:39
 */
namespace Admin\Controller;
use Admin\Model\GoodsModel;
use Admin\Controller\BaseController;

//商品控制器
class GoodsController extends BaseController{
    //商品展示
    public function showlist(){
        //实例化GoodsModel
        $goods = new GoodsModel();
        $newinfo = $goods->fetchPage();
        $info = $newinfo['pageinfo'];      //当前页数的数据信息
        $pagelist = $newinfo['pagelist'];  //页码列表
        $this->assign('info',$info);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }

    //商品添加
    public function append(){
        $goods = new GoodsModel();
        //两个逻辑 展示 收集数据
        if (!empty($_POST)){
            /*上传图片 制作缩略图*/
            if($_FILES['goods_img']['error'] === 0) {
                //1) 大图片上传
                $cfg = array(
                    'rootPath' => './Common/Uploads/',  //保存根路径
                );
                //设置附件的存储位置
                $up = new \Think\Upload($cfg);
                //uploadOne的返回值查看到附件在服务器的存储情况
                $z = $up->uploadOne($_FILES['goods_img']);
                //附件保存到数据库中，保存路径名即可
                $bigpicname = $up->rootPath . $z['savepath'] . $z['savename'];
                $_POST['goods_img'] = substr($bigpicname, 2);//去除'./'
                // 2)制作缩略图
                $im = new \Think\Image(); //实例化对象
                $im->open($bigpicname);   //打开原图片
                $im->thumb(320,320);        //等比例缩放
                $smallpicname = $up->rootPath.$z['savepath']."small_".$z['savename'];
                $im -> save($smallpicname); //存储缩略图到服务器
                $_POST['goods_thumb'] = substr($smallpicname,2);//去除'./'
            }
            $data = $goods->create($_POST);
            $data['promote_start_time'] = strtotime($_POST['promote_start_time']);
            $data['promote_end_time'] = strtotime($_POST['promote_end_time']);
            if ($_POST['is_promote']){
                $data['is_promote'] = 1;
            }
            if ($_POST['is_best']){
                $data['is_best'] = 1;
            }
            if ($_POST['is_new']){
                $data['is_new'] = 1;
            }
            if ($_POST['is_hot']){
                $data['is_hot'] = 1;
            }
            if ($_POST['is_onsale']){
                $data['is_onsale'] = 1;
            }
            //对富文本编辑器原生内容进行过滤，防止xss攻击
            $data['goods_desc'] = \fanXSS($_POST['goods_desc']);
            $z = $goods->add($data);
            if ($z){
                $this->success('添加商品成功','showlist',2);
            }else{
                $this->error('添加商品失败','append',2);
            }
        }else{
            $typeinfo = D('GoodsType')->order('type_id')->select(); //获得商品类型信息
            $catinfo = D('Category')->order('cat_path')->select();  //获得商品分类信息
            $brandinfo = D('Brand')->order('brand_id')->select();   //获取商品品牌信息
            $this->assign('typeinfo',$typeinfo);
            $this->assign('catinfo',$catinfo);
            $this->assign('brandinfo',$brandinfo);
            $this->display();
        }
    }

    //修改商品
    public function upd(){
        //两个逻辑 显示 修改商品
        $goods = new GoodsModel();
        $goods_id = I('get.goods_id');
        if (!empty($_POST)){  //修改商品信息
            $data = $goods->create($_POST);
            $data['promote_start_time'] = strtotime($_POST['promote_start_time']);
            $data['promote_end_time'] = strtotime($_POST['promote_end_time']);
            if ($_POST['is_promote']){ $data['is_promote'] = 1; }else{ $data['is_promote'] = 0; }
            if ($_POST['is_best']){ $data['is_best'] = 1; }else{ $data['is_best'] = 0; }
            if ($_POST['is_new']){ $data['is_new'] = 1; }else{ $data['is_new'] = 0; }
            if ($_POST['is_hot']){ $data['is_hot'] = 1; }else{ $data['is_hot'] = 0; }
            if ($_POST['is_onsale']){ $data['is_onsale'] = 1; }else{ $data['is_onsale'] = 0; }

            //对富文本编辑器原生内容进行过滤，防止xss攻击
            $data['goods_desc'] = \fanXSS($_POST['goods_desc']);
            $z = $goods->save($data);
            if (!($z === false)){
                $this->success('修改商品信息成功',U('showlist'),1);
            }else{
                $this->error('修改商品信息失败',U('upd',array('goods_id'=>$goods_id)),1);
            }
        }else{  //显示商品数据
            $info = $goods->where(array('goods_id'=>$goods_id))->find();
            $info['goods_weight'] = (float)$info['goods_weight'];
            $typeinfo = D('GoodsType')->order('type_id')->select(); //获得商品类型信息
            $catinfo = D('Category')->order('cat_path')->select();  //获得商品分类信息
            $brandinfo = D('Brand')->order('brand_id')->select();   //获取商品品牌信息

            $this->assign('typeinfo',$typeinfo);
            $this->assign('catinfo',$catinfo);
            $this->assign('brandinfo',$brandinfo);
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*添加商品  通过type_id获得对应的类型属性 */
    public function getAttrByType(){
        $type_id = I('get.type_id');
        $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
        echo json_encode($attrinfo);
    }

    /*修改商品  通过goods_id/type_id获得商品的属性的值*/
    public function getAttrValUpd(){
        $type_id = I('get.type_id');
        $goods_id = I('get.goods_id');
        //判断当前选取的type_id和本身商品的是否一致
        $goodsinfo = D('Goods')->find($goods_id);
        if($type_id!== $goodsinfo['type_id']){
            $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
            $info['mark'] = 1; //其他类型对应的属性信息
            $info[1] = $attrinfo;
            //$info是三维数组
            echo json_encode($info);
        }else {
            //数据表：goods_attr  attribute
            $attrinfo = D('GoodsAttr')
                ->alias('g')
                ->join('__ATTRIBUTE__ a on g.attr_id=a.attr_id')
                ->where(array('goods_id' => $goods_id))
                ->field('g.attr_id,g.attr_value,a.attr_name,a.attr_type,a.attr_opt')
                ->select();

            $tmp = array();
            foreach ($attrinfo as $k => $v) {
                if (!empty($tmp[$v['attr_id']]) || $v['attr_type'] == 1) {
                    //多选属性整合
                    $tmp[$v['attr_id']]['attr_id'] = $v['attr_id'];
                    $tmp[$v['attr_id']]['attr_name'] = $v['attr_name'];
                    $tmp[$v['attr_id']]['attr_type'] = $v['attr_type'];
                    $tmp[$v['attr_id']]['attr_opt'] = $v['attr_opt'];
                    $tmp[$v['attr_id']]['attr_value'][] = $v['attr_value'];
                } else {
                    //单选属性整合
                    $tmp[$v['attr_id']] = $v;
                }
            }
//        dump($tmp);//整合后的三维数组信息
            $info['mark'] = 2; //商品本身拥有的的属性信息
            $info[1] = $tmp;
            //$info变为一个四维数组
            echo json_encode($info);
        }
    }

    /*删除商品*/
    public function del(){
        $goods_id = I('get.goods_id');
        $z = D('Goods')->where(array('goods_id'=>$goods_id))->delete();
        if ($z){
            $this->success('删除商品成功',U('showlist'),1);
        }else{
            $this->error('删除商品失败',U('showlist'),1);
        }
    }

}

