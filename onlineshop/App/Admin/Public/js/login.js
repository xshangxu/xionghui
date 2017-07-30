/**
 * Created by Administrator on 2017/4/18.
 */

$(function () {
    var loginUsername = $('.username');
    var loginPassword = $('.password');
    var captcha = $('.captcha');
    var error = $('#error');

    //失去焦点判断
    loginUsername.blur(function () {
       if (loginUsername.val() == ''){
           error.text('用户名不能为空');
       }else {
           error.text('');
       }
    });

    loginPassword.blur(function () {
        if (loginPassword.val() == ''){
            error.text('密码不能为空');
        }else {
            error.text('');
        }
    });

    captcha.blur(function () {
        if (captcha.val() == ''){
            error.text('验证码不能为空');
        }else if(captcha.val().length != 4){
            error.text('请输入四位数的验证码');
        }else {
            error.text('');
        }

    });

    $('.button').click(function () {
            $('#login_form').ajaxSubmit({
                url: 'https://github.com/xshangxu/xionghui.git/index.php/Admin/Manage/login',
                type: 'post',
                dataType: 'json',
                beforeSubmit:function () {
                    if (loginUsername.val() == ''){
                        error.text('用户名不能为空');
                        return false;
                    }else if (loginPassword.val() == ''){
                        error.text('密码不能为空');
                        return false;
                    }else if (captcha.val() == ''){
                        error.text('验证码不能为空');
                        return false;
                    }else if(captcha.val().length != 4){
                        error.text('请输入四位数的验证码');
                        return false;
                    }else {
                        error.text('');
                        return true;
                    }
                },
                success:function (msg) {
                    if (msg.status == 1){
                        window.location.href = msg.url;
                    }else if (msg.status == 2){
                        error.text(msg.mean);
                        randyzm();
                    }else if (msg.status == 3){
                        error.text(msg.mean);
                        randyzm();
                    }else if (msg.status == 4){
                        error.text(msg.mean);
                        randyzm();
                    }
                }

            });

    });

    //刷新验证码
    randyzm=function(){
        $(".codeImg").attr("src", "/index.php/Admin/Manage/verifyImg/"+Math.random());
    }


});






















