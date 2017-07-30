<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4
 * Time: 11:34
 */
namespace Admin\Model;
use Think\Model;

/*用户模型*/
class UserModel extends Model{

    //自动完成设置添加时间
    protected $_auto = array(
        array('add_time','time',1,'function')
    );

    /*分页*/
    public function fetchPage(){
        $total = $this->count();
        $per = 10;
        $page = new \Tools\Page($total,$per);
        $pageinfo = $this->order('user_id desc')->limit($page->offset,$per )->select();
        $pagelist = $page -> fpage(array(3,4,5,6,7,8));
        return array(
            'pageinfo'  =>  $pageinfo,
            'pagelist'  =>  $pagelist
        );
    }


}

