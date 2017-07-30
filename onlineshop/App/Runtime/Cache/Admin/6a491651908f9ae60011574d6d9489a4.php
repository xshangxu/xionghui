<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
    <title>会员列表</title>

</head>
<body>
    <div class="head">
    <div class="head_left">后台管理中心</div>
    <ul>
        <!--<li>当前用户：<?php echo (session('mg_name')); ?></li>-->
        <!--<li><a href="">修改口令</a></li>-->
        <!--<li><a href="/index.php/Admin/Manage/logout">退出系统</a></li>-->
    </ul>
    <div class="head_right"></div>
</div>


    <script language=javascript>
    function expand(el)
    {
        childobj = document.getElementById("child" + el);

        if (childobj.style.display == 'none')
        {
            childobj.style.display = 'block';
        }
        else
        {
            childobj.style.display = 'none';
        }
        return;
    }
</script>
<div class="left">
<table height="100%" cellspacing=0 cellpadding=0 width=170 background=<?php echo (C("ADMIN_IMG_URL")); ?>/menu_bg.jpg border=0>
    <tr>
        <td valign=top align=middle>
            <table cellspacing=0 cellpadding=0 width="100%" border=0>
                <tr>
                    <td height=10></td>
                </tr>
            </table>
            <?php if(is_array($auth_infoA)): foreach($auth_infoA as $key=>$A): ?><table cellspacing=0 cellpadding=0 width=150 border=0>
                <tr height=22>
                    <td style="padding-left: 30px" background=<?php echo (C("ADMIN_IMG_URL")); ?>/menu_bt.jpg>
                        <a class=menuparent onclick=expand(<?php echo ($A["auth_id"]); ?>) href="javascript:void(0);"><?php echo ($A["auth_name"]); ?></a>
                    </td>
                </tr>
                <tr height=4>
                    <td></td>
                </tr>
            </table>
            <table id=child<?php echo ($A["auth_id"]); ?> style="display: none" cellspacing=0 cellpadding=0 width=150 border=0>
                <?php if(is_array($auth_infoB)): foreach($auth_infoB as $key=>$B): if($B['auth_pid'] == $A['auth_id']): ?><tr height=20>
                            <td align=middle width=30>
                                <img height=9 src="<?php echo (C("ADMIN_IMG_URL")); ?>/menu_icon.gif" width=9>
                            </td>
                            <td>
                                <a class=menuchild href="/index.php/Admin/<?php echo ($B["auth_c"]); ?>/<?php echo ($B["auth_a"]); ?>"><?php echo ($B["auth_name"]); ?></a>
                            </td>
                        </tr><?php endif; endforeach; endif; ?>
                <tr height=4>
                    <td colspan=2></td>
                </tr>
            </table><?php endforeach; endif; ?>

        </td>
        <td width=1 bgcolor=#d1e6f7></td>
    </tr>
</table>
</div>



    <div class="right">
        
    <div class="crumbs">
        当前位置：用户管理-><a href="/index.php/Admin/User/showlist">用户列表</a>
        <a href="/index.php/Admin/User/append">【添加用户】</a>
    </div>

    <table width="100%" cellpadding="1" cellspacing="0" class="tablelist" style="margin-top: 10px">
        <tr>
            <th>用户编号</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>手机号</th>
            <th>注册时间</th>
            <th colspan="2">操作</th>
        </tr>
        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                <td align="center"><?php echo ($v["user_id"]); ?></td>
                <td align="center"><?php echo ($v["user_name"]); ?></td>
                <td align="center"><?php echo ($v["user_email"]); ?></td>
                <td align="center"><?php echo ($v["user_tel"]); ?></td>
                <td align="center"><?php echo (date("Y-m-d H:i",$v["add_time"])); ?></td>
                <td align="center"><a href="/index.php/Admin/User/upd/user_id/<?php echo ($v["user_id"]); ?>">修改</a></td>
                <td align="center"><a href="javascript:;" onclick="if (confirm('确定要删除吗？')){
                    window.location.href = '/index.php/Admin/User/del/user_id/<?php echo ($v["user_id"]); ?>'
                }">删除</a></td>
            </tr><?php endforeach; endif; ?>
        <tr>
            <td align="center" colspan="9" class="page"><?php echo ($pagelist); ?></td>
        </tr>

    </table>


    </div>
</body>
</html>