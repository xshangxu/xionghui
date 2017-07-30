/**
 * Created by Administrator on 2017/4/28.
 */

$(function () {
    var username = $('.username');
    var pwd = $('.pwd');
    var pwdAgain = $('.pwdAgain');
    var tel = $('.tel');
    var email = $('.email');
    var checkCode = $('.checkcode input');
    var regBtn = $('.register_btn');

    //鼠标失去焦点判断
    username.blur(function () {
        if (username.val() == ''){
            $(this).next().text('*用户名不能为空');
        }else if (username.val().length < 3){
            $(this).next().text('*用户名不能少于3个字符');
        }else if (username.val().length > 20 ){
            $(this).next().text('*用户名不能大于20个字符');
        }else {
            $(this).next().text('');
        }
    });

    pwd.blur(function () {
        if (pwd.val() == ''){
            $(this).next().text('*密码不能为空');
        }else if (pwd.val().length < 6){
            $(this).next().text('*密码不能少于6个字符');
        }else if (pwd.val().length > 20 ){
            $(this).next().text('*密码不能大于20个字符');
        }else {
            $(this).next().text('');
        }
    });

    pwdAgain.blur(function () {
        if (pwdAgain.val() == ''){
            $(this).next().text('*确认密码不能为空');
        }else if (pwdAgain.val() != pwd.val() ){
            $(this).next().text('*上下密码不一致');
        }else{
            $(this).next().text('');
        }
    });

    tel.blur(function () {
        if (tel.val() == ''){
            $(this).next().text('*电话号码不能为空');
        }else if (!(/^1([23578])\d{9}$/.test(tel.val())) ){
            $(this).next().text('*请输入正确的手机号码');
        }else{
            $(this).next().text('');
        }
    });

    email.blur(function () {
        if (email.val() == ''){
            $(this).next().text('*邮箱不能为空');
        }else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) ){
            $(this).next().text('*请输入正确的邮箱地址');
        }else{
            $(this).next().text('');
        }
    });

    checkCode.blur(function () {
        if (checkCode.val() == ''){
            $('#code').text('*验证码不能不空');
        }else if (checkCode.val().length != 4){
            $('#code').text('*请输入4位的验证码');
        }else{
            $('#code').text('');
        }
    });

    regBtn.click(function () {
        $('#regForm').ajaxSubmit({
            url:'register',
            dataType: 'json',
            type: 'post',
            beforeSubmit:function () {
                if (username.val() == ''){
                    username.next().text('*用户名不能为空');
                    return false;
                }else if (username.val().length < 3){
                    username.next().text('*用户名不能少于3个字符');
                    return false;
                }else if (username.val().length > 20 ){
                    username.next().text('*用户名不能大于20个字符');
                    return false;
                }
                if (pwd.val() == ''){
                    pwd.next().text('*密码不能为空');
                    return false;
                }else if (pwd.val().length < 6){
                    pwd.next().text('*密码不能少于6个字符');
                    return false;
                }else if (pwd.val().length > 20 ){
                    pwd.next().text('*密码不能大于20个字符');
                    return false;
                }
                if (pwdAgain.val() == ''){
                    pwdAgain.next().text('*确认密码不能为空');
                    return false;
                }else if (pwdAgain.val() != pwd.val() ){
                    pwdAgain.next().text('*上下密码不一致');
                    return false;
                }
                if (tel.val() == ''){
                    tel.next().text('*电话号码不能为空');
                    return false;
                }else if (!(/^1([23578])\d{9}$/.test(tel.val())) ){
                    tel.next().text('*请输入正确的手机号码');
                    return false;
                }
                if (email.val() == ''){
                    email.next().text('*邮箱不能为空');
                    return false;
                }else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) ){
                    email.next().text('*请输入正确的邮箱地址');
                    return false;
                }
                if (checkCode.val() == ''){
                    $('#code').text('*验证码不能不空');
                    return false;
                }else if (checkCode.val().length != 4){
                    $('#code').text('*请输入4位的验证码');
                    return false;
                }
                return true;
            },
            success: function (msg) {
                console.log(msg);
                /*if (msg.status == 1){
                    confirm('恭喜您注册成功');
                    window.location.href = msg.url;
                }else if (msg.status == 2) {
                    confirm('很遗憾，注册失败');
                    window.location.href = msg.url;
                    restCaptcha();
                }else if (msg.status == 3){
                    $('#code').text('*验证码错误');
                    restCaptcha();
                }*/
            }
        });
    });

    //刷新验证码
    function restCaptcha() {
        $('#captchaImg').attr('src',"/index.php/Home/User/verifyImg/"+Math.random());
    }

});




