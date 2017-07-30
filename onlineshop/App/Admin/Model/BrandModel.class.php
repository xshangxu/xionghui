<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28
 * Time: 11:41
 */
namespace Admin\Model;
use Think\Model;

/*品牌模型*/
class BrandModel extends Model{

    /**
     * @param $data
     * @param $options
     * 插入数据之前的回调函数
     */
    protected function _before_insert(&$data,$options){
        //判断是否有图片提交 并处理
        if ($_FILES['error'] == 0){

        }
    }

    /**
     * 分页函数
     * @return array 返回每页显示数据和页码列表
     */
    public function fetchPage(){
        $total = $this->count();
        $per = 10;
        $page = new \Tools\Page($total,$per);
        $pageinfo = $this->order('brand_id')->limit($page->offset,$per )->select();
        $pagelist = $page -> fpage(array(3,4,5,6,7,8));
        return array(
            'pageinfo'  =>  $pageinfo,
            'pagelist'  =>  $pagelist
        );
    }


}

