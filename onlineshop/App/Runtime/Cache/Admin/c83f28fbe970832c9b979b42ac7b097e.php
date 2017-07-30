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
        当前位置：权限管理-><a href="/index.php/Admin/Auth/upd">修改权限</a>
        <a href="/index.php/Admin/Auth/showlist">【权限列表】</a>
    </div>

    <div class="tab-div">
        <form action="/index.php/Admin/Auth/upd/auth_id/117" method="post">
            <table width="100%" cellpadding="1" cellspacing="0" style="margin-top: 10px">
                <tr>
                    <td align="right" class="label">权限名称：</td>
                    <td><input type="text" name="auth_name" value="<?php echo ($info["auth_name"]); ?>"></td>
                </tr>
                <tr>
                    <td align="right" class="label">权限上级：</td>
                    <td>
                        <select name="auth_pid">
                            <option value="0">==请选择==</option>
                            <?php if(is_array($pinfo)): foreach($pinfo as $key=>$v): if(($info['auth_pid']) == $v['auth_id']): ?><option value='<?php echo ($v["auth_id"]); ?>' selected="selected">
                                        <?php else: ?>
                                    <option value='<?php echo ($v["auth_id"]); ?>'><?php endif; ?>
                                <?php echo str_repeat('&nbsp;&nbsp;',$v['auth_level']); echo ($v["auth_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="label">控制器：</td>
                    <td><input type="text" name="auth_c" value="<?php echo ($info["auth_c"]); ?>" /></td>
                </tr>
                <tr>
                    <td align="right" class="label">操作方法：</td>
                    <td><input type="text" name="auth_a" value="<?php echo ($info["auth_a"]); ?>" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type='submit' class="button" value="修改" style="margin: 20px 0px"></td>
                </tr>
            </table>
        </form>
    </div>

    </div>
</body>
</html>