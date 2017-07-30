<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 11:35
 */
namespace Admin\Model;
use Think\Model;

//属性模型
class AttributeModel extends Model{
    /*自动验证*/
    protected $_validate  = array(
        array('type_id','0','商品类型必须选择',0,'notequal')
    );

    /*属性列表分页*/
    public function fetchPage($total,$type_id){
        $per = 15;
        $page = new \Tools\Page($total,$per);
        if ($type_id){
            $pageinfo = $this->where(array('type_id'=>$type_id))->order('type_id')->limit($page->offset,$per)->select();
        }else{
            $pageinfo = $this->order('type_id')->limit($page->offset,$per)->select();
        }
        $pagelist = $page->fpage(array(3,4,5,6,7,8));
        return array(
            'pageinfo' => $pageinfo,
            'pagelist' => $pagelist
        );
    }


}



