<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/top.css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/footer.css">
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/top.js"></script>
    
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/user.css">
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/register.js"></script>

</head>
<body>
    <div class="top">
    <div class="top_inner">
        <div class="logo"><i>Eightnoo</i></div>
        <div class="navbar">
            <ul>
                <li><a class="nav_a nav_selected" href="<?php echo (C("HOME_URL")); ?>/Index/index">HOME</a></li>
                <li><a class="nav_a" href="<?php echo (C("HOME_URL")); ?>/Goods/goodslist">PRODUCTS</a></li>
                <li><a class="nav_a" href="#">INTRODUCE</a></li>
                <li><a class="nav_a" href="#">CONTACT US</a></li>
            </ul>
        </div>
        <div class="tools">
            <div class="search">
                <form action="#">
                    <input type="search" class="search_inp" >
                    <div class="icon"><i></i></div>
                </form>
            </div>
            <div class="icon">
                <a href="<?php echo (C("HOME_URL")); ?>/User/login" class="member"></a>
            </div>
            <div class="icon">
                <a href="#" class="cart"></a>
            </div>

        </div>
    </div>
</div>
    
    <!-- 注册主体部分start -->
    <div class="register">
        <div class="login_hd">
            <h2>User register</h2>
            <b></b>
            <h2>Existing account,<a href="/index.php/Home/User/login">login</a></h2>
        </div>
        <div class="login_bd">
            <div class="login_form register_form fl">
                <form action="" method="post" id="regForm">
                    <ul>
                        <li>
                            <label>User：</label>
                            <input type="text" class="txt username" name="user_name" />
                            <span class="error"></span>
                            <p>Please enter the username you want to set</p>
                        </li>
                        <li>
                            <label>Password：</label>
                            <input type="password" class="txt pwd" name="user_pwd" />
                            <span class="error"></span>
                            <p>Please enter the password you want to set</p>
                        </li>
                        <li>
                            <label>Confirm password：</label>
                            <input type="password" class="txt pwdAgain" name="password" />
                            <span class="error"></span>
                            <p> <span>Please enter your password again</span></p>
                        </li>
                        <li>
                            <label>Tel：</label>
                            <input type="tel" class="txt tel" name="user_tel" />
                            <span class="error"></span>
                            <p>Please enter your telephone number</p>
                        </li>
                        <li>
                            <label>Email：</label>
                            <input type="email" class="txt email" name="user_email" />
                            <span class="error"></span>
                            <p>Please enter your email address</p>
                        </li>
                        <li class="checkcode">
                            <label>Code：</label>
                            <input type="text"  name="checkcode" />
                            <img id="captchaImg" src="/index.php/Home/User/verifyImg"  alt="CAPTCHA" border="1"
                                 onclick= this.src="/index.php/Home/User/verifyImg/"+Math.random() style="cursor: pointer;"
                                 title="看不清？点击更换另一个验证码。" />
                            <span class="error" id="code"></span>
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <input type="button" value="REGISTER" class="register_btn" />
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <!-- 注册主体部分end -->

    <div class="footer">
    <div class="footer_inner">
        <a href="/" class="f_logo"><i>Eightnoo</i></a>
        <div class="f_contact">
            <table>
                <h3>Contact us</h3>
                <tr>
                    <td>Tel:</td>
                    <td>15361849607</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>598569322@qq.com</td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>Room 803, Building NO.168
                        Xinwei Village, Xili Town , Nanshan District
                        Shenzhen, Guangdong 518055
                        CN</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>