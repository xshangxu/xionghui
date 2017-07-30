<?php
return array(
	//'配置项'=>'配置值'

    //在页面底部设置显示跟踪信息
    "SHOW_PAGE_TRACE"        =>  true,
    //设置请求的默认分组
    "DEFAULT_MODULE"         =>  'Home',  // 默认模块
    "MODULE_ALLOW_LIST"      =>   array('Home','Admin'), //设置一个对比的分组列表

    //给系统静态资源文件请求路径设置常量
    //Home前台
    "CSS_URL"                =>  "/Home/Public/css",
    "JS_URL"                 =>  "/Home/Public/js",
    "IMG_URL"                =>  "/Home/Public/images",
    //Admin后台
    "Admin_CSS_URL"          =>  "/Admin/Public/css",
    "Admin_JS_URL"           =>  "/Admin/Public/js",
    "Admin_IMG_URL"          =>  "/Admin/Public/images",
    //富文本资源路径
    "TOOLS_URL"              =>   "/Tools",
    //前台
    "HOME_URL"               =>   "https://github.com/xshangxu/xionghui.git/index.php",
    //域名常量
    "REALM_URL"              =>   "https://github.com/xshangxu/xionghui.git/",
                                  /*https://github.com/xshangxu/xionghui.git/*/
    /* 数据库设置 */
    'DB_TYPE'                =>  'mysql',     // 数据库类型
    'DB_HOST'                =>  'localhost', // 服务器地址
    'DB_NAME'                =>  'onlineshop',          // 数据库名
    'DB_USER'                =>  'root',      // 用户名
    'DB_PWD'                 =>  '',          // 密码
    'DB_PORT'                =>  '3306',        // 端口
    'DB_PREFIX'              =>  'cz_',    // 数据库表前缀
    'DB_PARAMS'          	 =>  array(), // 数据库连接参数
    'DB_DEBUG'  			 =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'        =>  true,        // 启用字段缓存
    'DB_CHARSET'             =>  'utf8',      // 数据库编码默认采用utf8

);