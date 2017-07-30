<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="<?php echo (C("ADMIN_CSS_URL")); ?>/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    
    <style type="text/css">
        .search{ margin: 10px 0; border: 1px solid #BBDDE5; padding: 5px; color: #808080;background:#F4FaFb;
            padding: 5px;}
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
        
    <!-- 面包屑导航 -->
    <div class="crumbs">
        当前位置：商品管理-><a href="/index.php/Admin/Type/showlist">商品类型列表</a>->
        <a href="/index.php/Admin/Attribute/showlist">属性列表</a>
        <a href="/index.php/Admin/Attribute/append">【添加属性】</a>
    </div>

    <div class="search">
        <form action="/index.php/Admin/Attribute/showlist/type_id/2" style="height: 22px">
            <img style="vertical-align: middle" src="<?php echo (C("ADMIN_IMG_URL")); ?>/icon_search.gif" alt="SEARCH" width="26" height="22">
            按商品类型显示：
            <select name="" id="typesel" >
                <option value="0">所有商品类型</option>
                <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): if(($_GET['type_id']) == $v['type_id']): ?><option value="<?php echo ($v["type_id"]); ?>" selected>
                    <?php else: ?>
                        <option value="<?php echo ($v["type_id"]); ?>"><?php endif; ?>
                        <?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </form>
    </div>

    <table width="100%" cellpadding="1" cellspacing="0" class="tablelist">
        <tr>
            <th>序号</th>
            <th>属性名称</th>
            <th>商品类型</th>
            <th>属性值录入方式</th>
            <th>可选值列表</th>
            <th colspan="2">操作</th>
        </tr>
        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr class="attr">
                <td align="center"><?php echo ($v["attr_id"]); ?></td>
                <td align="center"><?php echo ($v["attr_name"]); ?></td>
                <td align="center"><?php echo ($v["type_name"]); ?></td>
                <?php if(($v["attr_input_type"]) == "0"): ?><td align="center">手工录入</td>
                <?php else: ?>
                    <td align="center">从列表中选择</td><?php endif; ?>
                <td align="center"><?php echo ($v["attr_opt"]); ?></td>
                <td align="center"><a href="/index.php/Admin/Attribute/upd/attr_id/<?php echo ($v["attr_id"]); ?>">修改</a></td>
                <td align="center"><a href="javascript:;" onclick="if (confirm('确定要删除该属性吗？')){
                    window.location.href = '/index.php/Admin/Attribute/del/attr_id/<?php echo ($v["attr_id"]); ?>';}">删除</a></td>
            </tr><?php endforeach; endif; ?>
        <tr><td colspan="7" align="center"  class="page"><?php echo ($pagelist); ?></td></tr>
    </table>

    <script type="text/javascript">
        $(function () {
            $(".attr td").eq(2).text();
            $('#typesel').change(function () {
                var type_id = $('#typesel option:selected').val();
                $.ajax({
                    url : '/index.php/Admin/Attribute/getAttr',
                    data : {'type_id': type_id },
                    dataType : 'json',
                    type : 'get',
                    success : function (msg) {
                        var optArr = $('#typesel option');
                        var str = '';
                        $('.tablelist tr:not(:first)').remove();
                        $.each(msg.pageinfo,function (index,item) {
                            str = "<tr>";
                            str += "<td align='center'>"+item.attr_id + "</td>";
                            str += "<td align='center'>"+item.attr_name + "</td>";
                            optArr.each(function (i,v) {
                                if ($(v).val() == item.type_id){
                                    var type_name = $(v).text();
                                    str += "<td align='center'>"+type_name + "</td>";
                                }
                            });
                            if (item.attr_input_type == 0){
                                str += '<td align="center">手工录入</td>';
                            }else if (item.attr_input_type == 1){
                                str += '<td align="center">从列表中选择</td>';
                            }
                            str += "<td align='center'>"+item.attr_opt + "</td>";
                            str += "<td align='center'><a href='/index.php/Admin/Attribute/upd/attr_id/"+ item.attr_id +"'>修改</a></td>";
                            str += '<td align="center"><a href="javascript:;" onclick="if (confirm(';
                            str += "'确定要删除该属性吗？')){ window.location.href = '/index.php/Admin/Attribute/del/attr_id/"+ item.attr_id +"';}";
                            str += '">删除</a></td>';
                            str += "</tr>";
                            $('.tablelist').append(str);
                        });
                        var pagestr = '<tr><td colspan="7" align="center"  class="page">'+ msg.pagelist + '</td></tr>';
                        $('.tablelist').append(pagestr);
                    }
                });
            });
        });
    </script>


    </div>
</body>
</html>