<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/25
 * Time: 17:18
 */
namespace Admin\Model;
use Think\Model;

/*权限模型*/
class AuthModel extends Model{

    /*插入数据后的回调函数*/
    public function _after_insert($data,$options){
        //对auth表的auth_path和auth_level进行维护
        if($data['auth_pid'] == 0){
            $auth_path = $data['auth_id'];
        }else{
            $pinfo = $this ->field('auth_path')->find($data['auth_pid']); //获得父级全路径
            $path = $pinfo['auth_path'];
            $auth_path = $path."-".$data['auth_id'];
        }
        $level = substr_count($auth_path,'-');  // 计算$auth_path中“-”的个数
        $this -> save(array('auth_id'=>$data['auth_id'],'auth_path'=>$auth_path,'auth_level'=>$level));
    }


}
