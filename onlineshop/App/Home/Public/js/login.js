/**
 * Created by Administrator on 2017/4/28.
 */

$(function () {
    var username = $('.user_name');
    var password = $('.user_pwd');
    var loginCode = $('.checkcode input');
    var loginBtn = $('.login_btn');
    var flag = false;

    //失去焦点判断
    username.blur(function () {
        if (username.val() == ''){
            $(this).next().text('*用户名不能为空');
        }else {
            $(this).next().text('');
        }
    });

    password.blur(function () {
        if (password.val() == ''){
            $(this).nextAll('span').text('*密码不能为空');
        }else {
            $(this).next().text('');
        }
    });

    loginCode.blur(function () {
        if (loginCode.val() == ''){
            $('#log_code').text('*验证码不能不空');
        }else if (loginCode.val().length != 4){
            $('#log_code').text('*请输入4位的验证码');
        }else {
            $('#log_code').text('');
        }
    });

    loginBtn.click(function () {
        $('#loginFrom').ajaxSubmit({
            url:'login',
            type: 'post',
            dataType: 'json',
            beforeSubmit: function () {
                if (username.val() == ''){
                    username.next().text('*用户名不能为空');
                    return false;
                }
                if (password.val() == ''){
                    password.nextAll('span').text('*密码不能为空');
                    return false;
                }
                if (loginCode.val() == ''){
                    $('#log_code').text('*验证码不能不空');
                    return false;
                }
                if (loginCode.val().length != 4){
                    $('#log_code').text('*请输入4位的验证码');
                    return false;
                }
                return true;
            },
            success: function (msg) {
                if (msg.status == 1){
                    window.location.href = msg.url;
                    //存储用户信息
                    localStorage.setItem("user_name", msg.user_name);
                    localStorage.setItem("user_id", msg.user_id);
                }else if (msg.status == 2){
                    $('#error').text(msg.mean);
                    randyzm();
                }else if (msg.status == 3){
                    $('#error').text(msg.mean);
                    randyzm();
                }else if (msg.status == 4){
                    $('#error').text(msg.mean);
                    randyzm();
                }
            }
        });
    });

    //刷新验证码
    randyzm = function(){
        $(".codeImg").attr("src", "/index.php/Home/User/verifyImg/"+Math.random());
    }



});






