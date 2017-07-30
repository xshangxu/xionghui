<?php
namespace Home\Controller;
use Home\Controller\HomeController;

//前台首页控制器
class IndexController extends HomeController {
    //网站首页
    public function index(){
        $this->display();
    }
}