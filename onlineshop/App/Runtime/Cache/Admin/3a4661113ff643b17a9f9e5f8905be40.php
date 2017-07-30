<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
    <title>修改会员信息</title>

</head>
<body>
    <div class="head">
    <div class="head_left"></div>
    <ul>
        <li>当前用户：<?php echo (session('mg_name')); ?></li>
        <li><a href="">修改口令</a></li>
        <li><a href="/index.php/Admin/Manage/logout">退出系统</a></li>
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
        当前位置：商品管理-><a href="/index.php/Admin/User/upd">修改用户信息</a>
        <a href="/index.php/Admin/User/showlist">【用户列表】</a>
    </div>

    <div class="tab-div">
        <form action="/index.php/Admin/User/upd/user_id/7.html" method="post">
            <table width="100%" cellpadding="1" cellspacing="0" style="margin-top: 10px">
                <tr>
                    <td align="right" class="label">用户名：</td>
                    <td><input type="text" name="user_name" value="<?php echo ($info["user_name"]); ?>"></td>
                </tr>
                <tr>
                    <td align="right" class="label">密码：</td>
                    <td><input type="password" name="user_pwd" value="<?php echo ($info["user_pwd"]); ?>"></td>
                </tr>
                <tr>
                    <td align="right" class="label">确认密码：</td>
                    <td><input type="password" name="pwd_again" value="<?php echo ($info["user_pwd"]); ?>"></td>
                </tr>
                <tr>
                    <td align="right" class="label">邮箱：</td>
                    <td><input type="email" name="user_email" value="<?php echo ($info["user_email"]); ?>" /></td>
                </tr>
                <tr>
                    <td align="right" class="label">电话号码：</td>
                    <td><input type="tel" name="user_tel" value="<?php echo ($info["user_tel"]); ?>" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type='submit' class="button" value="添加" style="margin: 20px 0px"></td>
                </tr>
            </table>
        </form>
    </div>


    </div>
</body>
</html>