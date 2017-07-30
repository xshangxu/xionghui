<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>登录</title>
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo (C("ADMIN_JS_URL")); ?>/login.js"></script>
</head>
<body style="background: #278296">
<!-- method="post" action="/index.php/Admin/Manage/login" -->
<form  name='theForm' id="login_form">
    <table cellspacing="0" cellpadding="0" style="margin-top: 100px" align="center">
        <tr>
            <td><img src="<?php echo (C("ADMIN_IMG_URL")); ?>/login.png" width="178" height="256" border="0" alt="ECSHOP" /></td>
            <td style="padding-left: 50px">
                <table>
                    <tr>
                        <td>账&nbsp;&nbsp;&nbsp;户：</td>
                        <td><input type="text" name="username" class="username" /></td>
                    </tr>
                    <tr>
                        <td>密&nbsp;&nbsp;&nbsp;码：</td>
                        <td><input type="password" name="password" class="password" /></td>
                    </tr>
                    <tr>
                        <td>验证码：</td>
                        <td><input type="text" name="captcha" class="captcha" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2" align="left">
                            <img class="codeImg" src="/index.php/Admin/Manage/verifyImg"  alt="CAPTCHA" border="1"
                                 onclick= this.src="/index.php/Admin/Manage/verifyImg/"+Math.random() style="cursor: pointer;"
                                 title="看不清？点击更换另一个验证码。" />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td id="error"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="button" value="进入管理中心" class="button" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">&raquo;
                            <a href="/index.php/Home/Index/index" style="color:white">返回首页</a> &raquo;
                            <a href="/index.php/Admin/Manage/register" style="color:white">注册</a> &raquo;
                            <a href="get_password.php?act=forget_pwd" style="color:white">忘记了密码吗？</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>

</body>