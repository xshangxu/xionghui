<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
    <link rel="stylesheet" href="<?php echo (C("ADMIN_CSS_URL")); ?>/goods.css">

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
        
    <!-- 面包屑导航 -->
    <div class="crumbs">
        当前位置：商品管理-><a href="/index.php/Admin/Goods/showlist">商品列表</a>
        <a href="/index.php/Admin/Goods/append">【添加商品】</a>
    </div>

    <!-- 查询 搜索 -->
    <div class="search">
        <form action="" id="searchFrom">
            <!--<img src="<?php echo (C("ADMIN_IMG_URL")); ?>/icon_search.gif" height="22" width="26"/>-->
            <!-- 分类 -->
            <select name="" >
                <option value="0">所有分类</option>
            </select>

            <!-- 品牌 -->
            <select name="">
                <option value="0">所有品牌</option>
            </select>

            <input type="submit" value="查询"  >
        </form>
    </div>

    <table width="100%" cellpadding="1" cellspacing="0" class="tablelist">
        <tr>
            <th>编号</th>
            <th>商品名称</th>
            <th>库存</th>
            <th>价格</th>
            <th>上架</th>
            <th>新品</th>
            <th>精品</th>
            <th>热销</th>
            <th colspan="2">操作</th>
        </tr>
        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr align="center" >
            <td><?php echo ($v["goods_id"]); ?></td>
            <td><?php echo ($v["goods_name"]); ?></td>
            <td><?php echo ($v["goods_number"]); ?></td>
            <td><?php echo ($v["shop_price"]); ?></td>
            <td>
                <?php
 if($v['is_onsale'] == '1'){ ?>
                    <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/yes.gif" />
                <?php
 }else{ ?>
                    <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/no.gif" />
                <?php } ?>
            </td>
            <td>
                <?php
 if($v['is_new'] == '1'){ ?>
                <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/yes.gif" />
                <?php
 }else{ ?>
                <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/no.gif" />
                <?php } ?>
            </td>
            <td>
                <?php
 if($v['is_best'] == '1'){ ?>
                <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/yes.gif" />
                <?php
 }else{ ?>
                <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/no.gif" />
                <?php } ?>
            </td>
            <td>
                <?php
 if($v['is_hot'] == '1'){ ?>
                <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/yes.gif" />
                <?php
 }else{ ?>
                <img src="<?php echo (C("ADMIN_IMG_URL")); ?>/no.gif" />
                <?php } ?>
            </td>
            <td><a href="/index.php/Admin/Goods/upd/goods_id/<?php echo ($v["goods_id"]); ?>">修改</a></td>
            <td><a href="javascript:;" onclick="if(confirm('你确定要删除该商品吗？')){
                window.location.href = '/index.php/Admin/Goods/del/goods_id/<?php echo ($v["goods_id"]); ?>';
            }">删除</a></td>
        </tr><?php endforeach; endif; ?>

        <tr>
            <td colspan="10" align="center" class="page"><?php echo ($pagelist); ?></td>
        </tr>
    </table>

    </div>
</body>
</html>