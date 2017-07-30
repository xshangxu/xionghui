<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/19
 * Time: 18:46
 */
namespace Admin\Model;
use Think\Model;

/* 商品模型类 */
class GoodsModel extends Model{
    //自动完成设置添加时间
    protected $_auto = array(
        array('add_time','time',1,'function')
    );

    /**
     * @param $data
     * @param $options
     * 插入数据之后的回调函数 处理商品相册
     */
    protected function _after_insert($data,$options){
        /*************商品属性存入商品属性关联表中*********************/
        if(!empty($_POST['attr_info'])){
            //遍历每个属性信息
            foreach($_POST['attr_info'] as $k => $v){
                //$k代表attr_id
                foreach($v as $kk => $vv){
                    //$vv代表每个属性的值
                    $arr = array(
                        'goods_id' => $data['goods_id'],
                        'attr_id'  => $k,
                        'attr_value' => $vv
                    );
                    D('GoodsAttr')->add($arr);
                }
            }
        }
        /*************商品属性存入商品属性关联表中*********************/

        /**********商品相册****************/
        $flag = false;
       //判断商品相册是否有图片上传
        foreach ($_FILES['img_url']['error'] as $k => $v){
            if ($v == 0){
                $flag = true;
                break;
            }
        }
        if ($flag){
            //商品相册图片上传
            $cfg = array(
                'rootPath' => "./Common/Pics/"    //相册保存跟路径
            );
            $up = new \Think\Upload($cfg);
            $z = $up->upload(array('large_img' => $_FILES['img_url']));
            $i = 0;
            foreach ($z as $k){
                $large_img = $up->rootPath.$k['savepath'].$k['savename'];
                $large_img = substr($large_img, 2);

                /* 制作缩略图*/
                $im = new \Think\Image();
                $im->open($large_img);
                $im->thumb(960,960);
                $middle_img = $up->rootPath.$k['savepath'].'middle_'.$k['savename'];
                $middle_img = substr($middle_img, 2);
                $im->save($middle_img);

                $im->open($large_img);
                $im->thumb(100,100);
                $small_img = $up->rootPath.$k['savepath'].'small_'.$k['savename'];
                $small_img = substr($small_img, 2);
                $im->save($small_img);

                $img_desc = $_POST['img_desc'][$i++];
                $arr = array(
                    'goods_id'   =>  $data['goods_id'],
                    'large_img'  =>  $large_img,
                    'middle_img' =>  $middle_img,
                    'small_img'  =>  $small_img,
                    'img_desc'   =>  $img_desc
                );
                D('Galary')->add($arr);
            }
        }
        /**********商品相册****************/
    }

    /**
     * 分页函数
     * @return array 返回每页显示数据和页码列表
     */
    public function fetchPage(){
        $total = $this->count();
        $per = 10;
        $page = new \Tools\Page($total,$per);
        $pageinfo = $this->order('goods_id desc')->limit($page->offset,$per )->select();
        $pagelist = $page -> fpage(array(3,4,5,6,7,8));
        return array(
            'pageinfo'  =>  $pageinfo,
            'pagelist'  =>  $pagelist
        );
    }

    /**
     * @param $data
     * @param $options
     * 修改数据之前的回调函数
     */
    protected function _before_update(&$data,$options){
        /************商品图片处理 star************/
        //判断是否有图片上传
        if ($_FILES['goods_img']['error'] == 0){
            // 1)删除原来的图片物理图片
            $logoinfo = $this->field('goods_img,goods_thumb')->find($options['where']['goods_id']);
            if(!empty($logoinfo['goods_img']) || !empty($logoinfo['goods_thumb'])){
                unlink($logoinfo['goods_img']);
                unlink($logoinfo['goods_thumb']);
            }
            // 2) 大图片上传
            $cfg = array(
                'rootPath' => './Common/Uploads/',  //保存根路径
            );
            //设置附件的存储位置
            $up = new \Think\Upload($cfg);
            //uploadOne的返回值查看到附件在服务器的存储情况
            $z = $up->uploadOne($_FILES['goods_img']);
            //附件保存到数据库中，保存路径名即可
            $bigpicname = $up->rootPath . $z['savepath'] . $z['savename'];
            $data['goods_img'] = substr($bigpicname, 2);//去除'./'

            // 3)制作缩略图
            $im = new \Think\Image(); //实例化对象
            $im->open($bigpicname);   //打开原图片
            $im->thumb(320,320);        //等比例缩放
            $smallpicname = $up->rootPath.$z['savepath']."small_".$z['savename'];
            $im -> save($smallpicname); //存储缩略图到服务器
            $data['goods_thumb'] = substr($smallpicname,2);//去除'./'
        }
        /************商品图片处理 end************/

        /************商品相册处理 star************/
        $flag = false;
        //判断商品相册是否有图片上传
        foreach ($_FILES['img_url']['error'] as $k => $v){
            if ($v == 0){
                $flag = true;
                break;
            }
        }
        if ($flag){
            //删除相册原来的图片
            D('Galary')->where(array('goods_id'=>$options['where']['goods_id']))->delete();
            //商品相册图片上传
            $cfg = array(
                'rootPath' => "./Common/Pics/"    //相册保存跟路径
            );
            $up = new \Think\Upload($cfg);
            $z = $up->upload(array('large_img' => $_FILES['img_url']));
            $i = 0;
            foreach ($z as $k){
                $large_img = $up->rootPath.$k['savepath'].$k['savename'];
                $large_img = substr($large_img, 2);

                /* 制作缩略图*/
                $im = new \Think\Image();
                $im->open($large_img);
                $im->thumb(960,960);
                $middle_img = $up->rootPath.$k['savepath'].'middle_'.$k['savename'];
                $middle_img = substr($middle_img, 2);
                $im->save($middle_img);

                $im->open($large_img);
                $im->thumb(100,100);
                $small_img = $up->rootPath.$k['savepath'].'small_'.$k['savename'];
                $small_img = substr($small_img, 2);
                $im->save($small_img);

                $img_desc = $_POST['img_desc'][$i++];
                $arr = array(
                    'goods_id'   =>  $options['where']['goods_id'],
                    'large_img'  =>  $large_img,
                    'middle_img' =>  $middle_img,
                    'small_img'  =>  $small_img,
                    'img_desc'   =>  $img_desc
                );
                D('Galary')->add($arr);
            }
        }
        /************商品相册处理 end************/
    }

    /**
     * @param $data
     * @param $options
     * 更新成功后的回调函数
     */
    protected function _after_update($data,$options){
        /**********商品属性更新处理 star************/
        // 删除原来得属性
        D('GoodsAttr')->where(array('goods_id'=>$data['goods_id']))->delete();
        //将新的属性插入到goods_attr数据表中
        if(!empty($_POST['attr_info'])){
            //变量每个属性信息
            foreach($_POST['attr_info'] as $k => $v){
                //$k代表attr_id
                foreach($v as $kk => $vv){
                    //$vv代表每个属性的值
                    $arr = array(
                        'goods_id' => $data['goods_id'],
                        'attr_id'  => $k,
                        'attr_value' => $vv
                    );
                    D('GoodsAttr')->add($arr);
                }
            }
        }
        /**********商品属性更新处理 end************/
    }

    /**
     * @param $data
     * @param $options
     * 删除商品之后执行的函数
     */
    protected function _after_delete($data,$options){
        //删除相册表中商品的图片
        D('Galary')->where(array('goods_id'=>$data['goods_id']))->delete();
        //删除商品属性表中商品的属性
        D('GoodsAttr')->where(array('goods_id'=>$data['goods_id']))->delete();
    }

}


