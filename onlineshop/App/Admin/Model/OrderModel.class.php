<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4
 * Time: 11:03
 */
namespace Admin\Model;
use Think\Model;

/*订单模型*/
class OrderModel extends Model{

    /*分页*/
    public function fetchPage(){
        $total = $this->count();
        $per = 6;
        $page = new \Tools\Page($total,$per);
        $pageinfo = $this->alias('o')->join('__ADDRESS__ a  on o.address_id=a.address_id')
            ->join('__USER__ u on o.user_id=u.user_id')
            ->field('o.order_id,o.goods_img,a.name,o.goods_amount,o.order_time,o.order_status,u.user_name')
            ->limit($page->offset,$per )
            ->select();
        $pagelist = $page -> fpage(array(3,4,5,6,7,8));
        return array(
            'pageinfo'  =>  $pageinfo,
            'pagelist'  =>  $pagelist
        );
    }


}











