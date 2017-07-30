/**
 * Created by Administrator on 2017/6/24.
 */
$(function () {

    /*轮播图*/
    var banner_img = $('.banner_img li');
    var banner_num = $('.banner_num li');
    var i = 0;
    var index = 0;
    var t;

    slider(0);
    /*自动轮播*/
    function slider(i) {
        banner_img.eq(i).fadeIn().siblings().fadeOut();
        banner_num.eq(i).addClass('num_active').siblings().removeClass('num_active');
        index = i;
        t = setInterval(function () {
            if (i < 4){
                banner_img.eq(++i).fadeIn().siblings().fadeOut();
                banner_num.eq(i).addClass('num_active').siblings().removeClass('num_active');
                index = i;  //存放下标
            }else {
                i = -1;
                banner_img.eq(++i).fadeIn().siblings().fadeOut();
                banner_num.eq(i).addClass('num_active').siblings().removeClass('num_active');
                index = i;  //存放下标
            }
        },3000);
    }

    $('.banner').hover(function () {
        $('.prev').fadeIn();
        $('.next').fadeIn();
    },function () {
        $('.prev').fadeOut();
        $('.next').fadeOut();
    });

    /*上一张图点击事件*/
    $('.prev').click(function () {
        clearInterval(t); //清除上一个定时器
        if (index == 0){
            i = 4;
        }else {
            i = --index;
        }
        slider(i);
    });
    /*下一张图点击事件*/
    $('.next').click(function () {
        clearInterval(t); //清除上一个定时器
        if (index == 4){ i = 0; }else { i = ++index; }
        slider(i);
    });
    /*数字的点击事件*/
    banner_num.click(function () {
        clearInterval(t); //清除上一个定时器
        slider($(this).index());
    });

});

