<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
    <style type="text/css">
        .attrfont{ font-size: 14px; }
        .descfont{ font-size: 14px; color: #aaa; }
    </style>

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
        当前位置：商品管理-><a href="/index.php/Admin/Type/showlist">商品类型列表</a>->
        <a href="/index.php/Admin/Attribute/upd">修改属性</a>
        <a href="/index.php/Admin/Attribute/showlist">【属性列表】</a>
    </div>

    <div class="tab-div tabbody-div">
        <form action="/index.php/Admin/Attribute/upd/attr_id/36" method="post">
            <table width="100%">
                <tr>
                    <td align="right" class="label">属性名称：</td>
                    <td><input type="text" name="attr_name" value="<?php echo ($info["attr_name"]); ?>"></td>
                </tr>
                <tr>
                    <td align="right" class="label">所属商品类型：</td>
                    <td>
                        <select name="type_id" id="">
                            <option value="0">商品类型</option>
                            <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): if(($info["type_id"]) == $v["type_id"]): ?><option value="<?php echo ($v["type_id"]); ?>" selected="selected">
                                 <?php else: ?>
                                    <option value="<?php echo ($v["type_id"]); ?>"><?php endif; ?>
                                <?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="label">属性是否可选：</td>
                    <td class="attrfont">
                        <?php if(($info["attr_input_type"]) == "0"): ?><input type="radio" name="attr_type" value="0" checked> 唯一属性
                        <?php else: ?>
                            <input type="radio" name="attr_type" value="0" > 唯一属性<?php endif; ?>
                        <?php if(($info["attr_input_type"]) == "1"): ?><input type="radio" name="attr_type" value="1" checked> 单选属性
                            <?php else: ?>
                            <input type="radio" name="attr_type" value="1"> 单选属性<?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="descfont">"单选属性"表示该属性的值唯一；“单选属性”表示该属性的值有多个，购买商品时只能选择其中一个值</td>
                </tr>
                <tr>
                    <td align="right" class="label">该值得录入方式：</td>
                    <td class="attrfont">
                        <?php if(($info["attr_input_type"]) == "0"): ?><input type="radio" name="attr_input_type" value="0" checked>手工录入
                        <?php else: ?>
                            <input type="radio" name="attr_input_type" value="0">手工录入<?php endif; ?>
                        <?php if(($info["attr_input_type"]) == "1"): ?><input type="radio" name="attr_input_type" value="1" checked>重下面列表中选择（一行代表一个可选值）
                         <?php else: ?>
                            <input type="radio" name="attr_input_type" value="1">重下面列表中选择（一行代表一个可选值）<?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="label">可选值列表：</td>
                    <td><textarea name="attr_opt"  cols="30" rows="5"><?php echo ($info["attr_opt"]); ?></textarea></td>
                </tr>
            </table>
            <div class="button-div" style="padding-left: 335px">
                <input type="submit" class="button" value="确定">
                <input type="reset" class="button" value="重置">
            </div>
        </form>
    </div>



    </div>
</body>
</html>