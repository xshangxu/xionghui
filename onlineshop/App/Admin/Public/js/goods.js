/**
 * Created by Administrator on 2017/4/19.
 */

/**********商品添加****************/
$(function () {
    $('.tabbar-div span').click(function () {
        $(this).attr('class','tab-front').siblings().attr('class','tab-back');
        var index = $(this).index();
        $('#addFrom table.chl').eq(index).css('display','table').siblings('table').css('display','none');
        $('#updFrom table.chl').eq(index).css('display','table').siblings('table').css('display','none');
    });

    /*通用信息 促销价格复选框*/
    var falg = true;
    $('.check_price').click(function () {
        if (falg){
            $(this).attr('checked','checked');
            $('.disable').removeAttr('disabled');
            falg = false;
        }else {
            $(this).removeAttr('checked');
            $('.disable').attr('disabled','disabled');
            falg = true;
        }
    });

    /*详细信息  富文本*/
 /*   window.UEDITOR_CONFIG.toolbars = [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
    ]];
    var ue = UE.getEditor('goods_desc');*/

    console.log($('#goods_desc').val());
    var features = $('#goods_desc').val();
});

/*商品相册*/
$(function () {
    $('.add_img').click(function () {
        var str = "<tr><td align='center'><a href='javascript:;' class='del_img'>[-]</a>图片描述：<input type='text' name='img_desc[]'>&nbsp;&nbsp;<input type='file' name='img_url[]'> </td> </tr>";
        $('.chl').eq(4).append(str);
    });

    $(document).on('click','.del_img',function () {
        $(this).parent().parent().remove();
    });
});


/*添加页面  ： 商品属性*/
$(function () {

    /*选择框添加点击事件  添加节点*/
    $(document).on('click','.attrSel',function () {
        var sel1 = $(this).parent().parent().parent();
        var sel2 = sel1.clone();
        sel2.find('span').remove();
        sel2.find('strong').append("<span class='selDel'>[-]</span>");
        sel1.after(sel2);
    });

    /* 移除节点 */
    $(document).on('click','.selDel',function () {
        $(this).parent().parent().parent().remove();
    });

    /*商品类型添加change事件*/
    $('.goods_type').change(function () {
        showArr();
    });
    /*根据不同的商品类型展示相对应的商品属性*/
    function showArr() {
        var type_id = $('.goods_type option:selected').val();
        $.ajax({
            url:'https://github.com/xshangxu/xionghui.git/index.php/Admin/Goods/getAttrByType',
            data : {'type_id': type_id },
            dataType : 'json',
            type : 'get',
            success:function (msg) {
                var str = "";
                $.each (msg,function (k,v) {
                    if (v.attr_type == 0){
                        str += '<tr>';
                        str += '<td align="right" class="label">'+ v.attr_name +'：</td>';
                        str += '<td><input type="text" name="attr_info[' + v.attr_id + '][]"></td>';
                        str += '</tr>';
                    }else if (v.attr_type == 1){
                        str += '<tr>';
                        str += '<td align="right" class="label"><strong><span style="cursor: pointer;" class="attrSel">[+]</span></strong>'+ v.attr_name +'：</td>';
                        str += '<td><select id=""  name="attr_info[' + v.attr_id + '][]">';
                        str += '<option value="0">--请选择--</option>';
                        var arr = v.attr_opt.split('\n');
                        for (var i = 0, j = arr.length; i < j; i++){
                            str += '<option value="'+ arr[i] +'">'+ arr[i] +'</option>';
                        }
                        str += '</select></td>';
                        str += '</tr>';
                    }
                });
                $('#goodsAttr tr:not(:first)').remove();
                $('#goodsAttr').append(str);
            }
        })
    }
});
/**********商品添加****************/

/**********修改商品****************/
//*商品属性*/
$(function () {

    /*多选框点击事件*/
    $(document).on('click','.attrSelUpd',function () {
        var sel1 = $(this).parent().parent().parent();
        var sel2 = sel1.clone();
        sel2.find('span').remove();
        sel2.find('strong').append("<span class='selDel'>[-]</span>");
        sel1.after(sel2);
    });
    /* 移除节点 */
    $(document).on('click','.selDelUpd',function () {
        $(this).parent().parent().parent().remove();
    });

    getAttrVal();  //商品属性初始化
    $('.goods_type_upd').change(function () {
        getAttrVal();
    });

    function getAttrVal() {
        var type_id = $('.goods_type_upd option:selected').val();
        var goods_id = $('input[name=goods_id]').val();
        $.ajax({
            url:'https://github.com/xshangxu/xionghui.git/index.php/Admin/Goods/getAttrValUpd',
            data : {'type_id': type_id, 'goods_id':goods_id },
            dataType : 'json',
            type : 'get',
            success:function (msg) {
                var s = "";
                if(msg.mark==2){
                    //1) 显示本身拥有的类型对应的属性信息
                    $.each(msg[1],function(k,v){
                        if(v.attr_type == 0){
                            //单选
                            s += "<tr><td align='right' class='label'>"+v.attr_name+"：</td>";
                            s += "<td><input type='text' name='attr_info["+v.attr_id+"][]' value='"+v.attr_value+"'></td>";
                            s += "</tr>";
                        }else{
                            //多选
                            //多选的值的个数一共有多少，根据值的个数显示对应的tr个数
                            var value_num = v.attr_value.length;

                            for(var w=0; w<value_num; w++){
                                s += "<tr><td align='right' class='label'>";
                                if(w==0)
                                    s += "<strong><span class='attrSelUpd'>[+]</span></strong>";
                                else
                                    s += "<strong><span class='selDelUpd'>[-]</span></strong>";
                                s +=  v.attr_name+"：</td>";
                                s += "<td><select name='attr_info["+v.attr_id+"][]'>";
                                s += "<option value='0'>--请选择--</option>";
                                var opt = v.attr_opt.split('\n');//把多选项目变为数组
                                $.each(opt,function(kk,vv){
                                    if(v.attr_value[w] == vv)
                                        s += "<option value='"+vv+"' selected='selected'>"+vv+"</option>";
                                    else
                                        s += "<option value='"+vv+"'>"+vv+"</option>";
                                });
                                s += "</select></td>";
                                s += "</tr>";
                            }
                        }
                        $('#goodsAttrUpd tr:not(:first)').remove();//删除旧的tr信息
                        $('#goodsAttrUpd tr:first').after(s);
                    });
                }else {
                    //2) 显示选取的其他的类型的属性信息
                    $.each (msg[1],function (k,v) {
                        if (v.attr_type == 0){
                            s += '<tr>';
                            s += '<td align="right" class="label">'+ v.attr_name +'：</td>';
                            s += '<td><input type="text" name="attr_info[' + v.attr_id + '][]"></td>';
                            s += '</tr>';
                        }else if (v.attr_type == 1){
                            s += '<tr>';
                            s += '<td align="right" class="label"><strong><span style="cursor: pointer;" class="attrSel">[+]</span></strong>'+ v.attr_name +'：</td>';
                            s += '<td><select id=""  name="attr_info[' + v.attr_id + '][]">';
                            s += '<option value="0">--请选择--</option>';
                            var arr = v.attr_opt.split('\n');
                            for (var i = 0, j = arr.length; i < j; i++){
                                s += '<option value="'+ arr[i] +'">'+ arr[i] +'</option>';
                            }
                            s += '</select></td>';
                            s += '</tr>';
                        }
                    });
                }
                $('#goodsAttrUpd tr:not(:first)').remove();//删除旧的tr信息
                $('#goodsAttrUpd tr:first').after(s);

            }
        })
    }
});

/**********修改商品****************/
