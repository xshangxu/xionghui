<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 23:46
 */

namespace Admin\Model;
use Think\Model;

/*分类模型*/
class CategoryModel extends Model{

    /*插入数据后的回调函数*/
    public function _after_insert($data,$options){
        //对cat表的cat_path和cat_level进行维护
        if($data['cat_pid'] == 0){
            $cat_path = $data['cat_id'];
        }else{
            $pinfo = $this ->field('cat_path')->find($data['cat_pid']); //获得父级全路径
            $path = $pinfo['cat_path'];
            $cat_path = $path."-".$data['cat_id'];
        }
        $level = substr_count($cat_path,'-');  // 计算$cat_path中“-”的个数
        $this -> save(array('cat_id'=>$data['cat_id'],'cat_path'=>$cat_path,'cat_level'=>$level));
    }

    public function fetchPage(){
        $total = $this->count();
        $per = 10;
        $page = new \Tools\Page($total,$per);
        $pageinfo = $this->order('cat_path')->limit($page->offset,$per )->select();
        $pagelist = $page -> fpage(array(3,4,5,6,7,8));
        return array(
            'pageinfo'  =>  $pageinfo,
            'pagelist'  =>  $pagelist
        );
    }
}




