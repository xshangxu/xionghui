<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 16:12
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;


class IndexController extends BaseController{
    //后台首页
    public function index(){
        $this->display();
    }


}