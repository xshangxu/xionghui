<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
    <link rel="stylesheet" href="<?php echo (C("ADMIN_CSS_URL")); ?>/goods.css">
    <script type="text/javascript" src="<?php echo (C("TOOLS_URL")); ?>/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?php echo (C("TOOLS_URL")); ?>/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" src="<?php echo (C("TOOLS_URL")); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/goods.js"></script>

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
        
    <div>
        <!-- 面包屑导航 -->
        <div class="crumbs">
            当前位置：商品管理-><a href="/index.php/Admin/Goods/append">添加商品</a>
            <a href="/index.php/Admin/Goods/showlist">【商品列表】</a>
        </div>

        <!-- 添加商品属性部分 -->
        <div class="tab-div">
            <div class="tabbar-div">
                <p>
                    <span class="tab-front" id="general-tab">通用信息</span>
                    <span class="tab-back" id="detail-tab">详细信息</span>
                    <span class="tab-back" id="mix-tab">其他信息</span>
                    <span class="tab-back" id="properties-tab">商品属性</span>
                    <span class="tab-back" id="gallery-tab">商品相册</span>
                </p>
            </div>

            <div class="tabbody-div">
                <form action="/index.php/Admin/Goods/append" method="post" id="addFrom" enctype="multipart/form-data">
                    <!-- 通用信息 -->
                    <table align="center" width="90%" class="chl">
                        <tr>
                            <td align="right" class="label">商品名称：</td>
                            <td><input type="text" name="goods_name"></td>
                        </tr>
                        <tr>
                            <td align="right"  class="label">商品分类：</td>
                            <td>
                                <select id=""  name="cat_id">
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($catinfo)): foreach($catinfo as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$v['cat_level']); echo ($v["cat_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">商品品牌：</td>
                            <td>
                                <select name="brand_id" >
                                    <option value="0">--请选择--</option>
                                    <?php if(is_array($brandinfo)): foreach($brandinfo as $key=>$v): ?><option value="<?php echo ($v["brand_id"]); ?>"><?php echo ($v["brand_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">市场售价：</td>
                            <td>
                                <input type="text" name="market_price" value="0.00">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">本店售价：</td>
                            <td>
                                <input type="text" name="shop_price" value="0.00">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">
                                    <input type="checkbox" name="is_promote" class="check_price">促销价格：
                            </td>
                            <td>
                                <input type="text" name="promote_price" value="0.00" disabled="disabled" class="disable">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">促销起始时间：</td>
                            <td>
                                <input type="date" name="promote_start_time" disabled="disabled" class="disable">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">促销截止时间：</td>
                            <td>
                                <input type="date" name="promote_end_time" disabled="disabled" class="disable">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">上传商品图片：</td>
                            <td>
                                <input type="file" name="goods_img">
                            </td>
                        </tr>
                    </table>
                    <!-- 详细信息 -->
                    <table align="center" width="90%" class="chl" style="display: none">
                        <tr>
                            <td align="right" class="label">Features：</td>
                            <td>
                                <textarea name="goods_desc" id="goods_desc" style="width: 800px; height: 150px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">Package included：</td>
                            <td>
                                <textarea name="goods_package"  style="width: 800px; height: 100px;"></textarea>
                            </td>
                        </tr>
                    </table>
                    <!-- 其他信息 -->
                    <table align="center" width="90%" class="chl" style="display: none">
                        <tr>
                            <td align="right" class="label">商品货号：</td>
                            <td><input type="text" name="goods_sn"></td>
                        </tr>
                        <tr>
                            <td align="right" class="label">商品重量：</td>
                            <td><input type="text" name="goods_weight">
                                <select name="weight_unit">
                                    <option value="0">千克</option>
                                    <option value="1">克</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">商品库存数量：</td>
                            <td><input type="text" name="goods_number"></td>
                        </tr>
                        <tr>
                            <td align="right" class="label">库存警告数量：</td>
                            <td><input type="text" name="warning_number"></td>
                        </tr>
                        <tr>
                            <td align="right" class="label">商品链接：</td>
                            <td><input type="text" name="goods_link"></td>
                        </tr>
                        <tr>
                            <td align="right" class="label">加入推荐：</td>
                            <td>
                                <input type="checkbox" name="is_best">精品
                                <input type="checkbox" name="is_new">新品
                                <input type="checkbox" name="is_hot">热销
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">上架：</td>
                            <td>
                                <input type="checkbox" checked="checked" name="is_onsale">打勾表示允许销售，否则不允许销售
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="label">商品简单描述：</td>
                            <td>
                                <textarea name="goods_brief" cols="40" rows="5"></textarea>
                            </td>
                        </tr>
                    </table>
                    <!-- 商品属性 -->
                    <table align="center" width="90%" class="chl" id="goodsAttr" style="display: none">
                        <tr>
                            <td align="right" class="label">商品类型：</td>
                            <td>
                                <select name="type_id" class="goods_type">
                                    <option value="0">请选择商品类型</option>
                                    <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <!-- 商品相册 -->
                    <table align="center" width="90%" class="chl" style="display: none">
                        <tr>
                            <td align="center">
                                <a href="javascript:;" class="add_img">[+]</a>图片描述：
                                <input type="text" name="img_desc[]">
                                <input type="file" name="img_url[]">
                            </td>
                        </tr>
                    </table>

                    <div class="button-div">
                        <input type="submit" class="button" value="确定">
                        <input type="reset" class="button" value="重置">
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
</body>
</html>