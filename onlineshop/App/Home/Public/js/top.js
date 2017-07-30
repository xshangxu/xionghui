/**
 * Created by Administrator on 2017/7/7.
 */
$(function () {
    /*头部小图标hover事件*/
    $('.search').hover(function () {
        $('.search i').addClass('icon_hover');
        $('.search_inp').css('borderColor','#00a7e1');
    },function () {
        $('.search i').removeClass('icon_hover');
        $('.search_inp').css('borderColor','#3d3938');
    });

    $('.member').hover(function () {
        $(this).addClass('icon_hover');
    },function () {
        $(this).removeClass('icon_hover');
    });

    $('.cart').hover(function () {
        $(this).addClass('icon_hover');
    },function () {
        $(this).removeClass('icon_hover');
    });

    $(".nav_a").click(function () {
        $(this).addClass('nav_selected').parent().siblings().children().removeClass('nav_selected');
    });


});