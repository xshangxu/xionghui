<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
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
        当前位置：权限管理-><a href="/index.php/Admin/Auth/showlist">权限列表</a>
        <a href="/index.php/Admin/Auth/append">【添加权限】</a>
    </div>

    <table width="100%" cellpadding="1" cellspacing="0" class="tablelist" style="margin-top: 10px">
        <tr>
            <th>序号</th>
            <th>权限名称</th>
            <th>权限父ID</th>
            <th>模块</th>
            <th>方法</th>
            <th>全路径</th>
            <th>级别</th>
            <th colspan="2">操作</th>
        </tr>
        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr align="center">
                <td><?php echo ($v["auth_id"]); ?></td>
                <td><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$v['auth_level']); echo ($v["auth_name"]); ?></td>
                <td><?php echo ($v["auth_pid"]); ?></td>
                <td><?php echo ($v["auth_c"]); ?></td>
                <td><?php echo ($v["auth_a"]); ?></td>
                <td><?php echo ($v["auth_path"]); ?></td>
                <td><?php echo ($v["auth_level"]); ?></td>
                <td><a href="/index.php/Admin/Auth/upd/auth_id/<?php echo ($v["auth_id"]); ?>">修改</a></td>
                <td><a href="javascript:;"onclick="if(confirm('确定要删除吗？')){
                     window.location.href = '/index.php/Admin/Auth/del/auth_id/<?php echo ($v["auth_id"]); ?>';}">删除</a></td>

            </tr><?php endforeach; endif; ?>
    </table>


    </div>
</body>
</html>