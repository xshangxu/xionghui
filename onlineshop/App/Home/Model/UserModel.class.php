<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28
 * Time: 17:21
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model{

    //自动完成设置添加时间
    protected $_auto = array(
        array('add_time','time',1,'function')
    );



}


