/**
 * Created by Administrator on 2017/7/7.
 */
/*******************产品列表页面*************************/
$(function () {

    /*产品类型点击事件*/

    if ($('.type a').hasClass('type_active')){
        $('.type a').click(function () {
            $(this).addClass('type_active').siblings().removeClass('type_active');
        });
    }else {
        $('.type a').eq(0).addClass('type_active');
    }
    console.log($('.type a').hasClass('type_active'));
});

/*******************产品详情页面************************************/
$(function () {
    /*图片大于五张则显示左右箭头*/
    if ($('.carousel_page li:last').index() >= 4){
        $('.ctrl').css('display','block');
    }

    /*为每个图片自定义一个i的属性*/
    $('.carousel_page img').each(function (index,val) {
        $(this).attr('i',index);
    });

    /*商品缩略图点击事件*/
    $('.carousel_page img').click(function () {
        $(this).addClass('img_active').parent().siblings().children().removeClass('img_active');
        $('.carousel_image img').eq($(this).attr('i')).css('display','block').siblings().css('display','none');
    });

    /*图片左移*/
    $('.product_prev').click(function () {

    });

    /*初始化第一个选中*/
    $('.info_color a').eq(0).addClass('color_selected').end().filter('.color_selected').attr('checked','checked');
    /*选择颜色点击事件*/
    $('.info_color a').click(function () {
        $(this).addClass('color_selected').attr('checked','checked').siblings().removeClass('color_selected').removeAttr('checked');
    });

    /*数量减少点击事件*/
    var i;
    var num = $('.number');
    $('.reduce_l').click(function () {
        i = num.val() - 0; //字符串类型转化为数值型
        if (i <= 1 ){
            num.val(1);
        }else {
            num.val(--i);
        }
    });
    /*数量添加点击事件*/
    $('.add_r').click(function () {
        i = num.val() - 0;
        num.val(++i);
    });
    /*在输入框直接输入数量*/
    num.blur(function () {
        if (num.val() <= 1){
            num.val(1);
        }else {
            num.val(parseInt(num.val()));
        }
    });

    /*产品特点及套餐点击事件*/
    $('.prod_tab:eq(0)').click(function () {
        $(this).addClass('prod_tab_sel').siblings().removeClass('prod_tab_sel');
        $("html, body").animate({
                scrollTop: $(".prod_fea").offset().top - 81 },
            {duration: 500,easing: "swing"});
        return false;
    });

    $('.prod_tab:eq(1)').click(function () {
        $(this).addClass('prod_tab_sel').siblings().removeClass('prod_tab_sel');
        console.log($(".prod_pack").offset().top);
        $("html, body").animate({
                scrollTop: $(".prod_pack").offset().top },
            {duration: 500,easing: "swing"});
        return false;
    });


});







