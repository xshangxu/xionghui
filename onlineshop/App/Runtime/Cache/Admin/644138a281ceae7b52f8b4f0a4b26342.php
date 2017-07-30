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
        当前位置：商品管理-><a href="/index.php/Admin/Category/upd">修改分类</a>
        <a href="/index.php/Admin/Category/showlist">【分类列表】</a>
    </div>

    <div class="tab-div">
        <form action="/index.php/Admin/Category/upd/cat_id/1" method="post">
            <table width="100%" cellpadding="1" cellspacing="0" style="margin-top: 10px">
                <tr>
                    <td align="right" class="label">分类名称：</td>
                    <td><input type="text" name="cat_name" value="<?php echo ($info["cat_name"]); ?>"></td>
                </tr>
                <tr>
                    <td align="right" class="label">分类上级：</td>
                    <td>
                        <select name="cat_pid">
                            <option value="0">==请选择==</option>
                            <?php if(is_array($pinfo)): foreach($pinfo as $key=>$v): if(($info['cat_pid']) == $v["cat_id"]): ?><option value='<?php echo ($v["cat_id"]); ?>' selected="selected">
                                        <?php else: ?>
                                    <option value='<?php echo ($v["cat_id"]); ?>'><?php endif; ?>
                                <?php echo str_repeat('&nbsp;&nbsp;',$v['cat_level']); echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
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