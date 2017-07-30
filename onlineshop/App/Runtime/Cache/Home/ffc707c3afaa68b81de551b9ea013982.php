<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/top.css">
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/footer.css">
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/top.js"></script>
    
    <title>Eightnoo</title>
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/index.css" >
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/index.js"></script>

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
    
    <div class="banner">
        <ul class="banner_img">
            <li><img src="<?php echo (C("IMG_URL")); ?>/banner1.jpg" alt=""></li>
            <li><img src="<?php echo (C("IMG_URL")); ?>/banner2.jpg" alt=""></li>
            <li><img src="<?php echo (C("IMG_URL")); ?>/banner3.jpg" alt=""></li>
            <li><img src="<?php echo (C("IMG_URL")); ?>/banner4.jpg" alt=""></li>
            <li><img src="<?php echo (C("IMG_URL")); ?>/banner5.jpg" alt=""></li>
        </ul>

        <span class="prev">&lt;</span>
        <span class="next">&gt;</span>

        <ul class="banner_num">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <div class="module">
        <div class="module_title">Best Sellers</div>
        <div class="module-description">Browse our most popular products.</div>
        <div class="module_items">
            <a class="item" href="#">
                <img src="<?php echo (C("IMG_URL")); ?>/product1.jpg" alt="">
                <div class="title">PowerCore II 20000mAh Portable Charger</div>
                <div class="description">20000mah Power Bank with 3 PowerIQ, 6A Output, Dual Input and 4A Fast Recharging</div>
            </a>
            <a class="item" href="#">
                <img src="<?php echo (C("IMG_URL")); ?>/product1.jpg" alt="">
                <div class="title">PowerCore II 20000mAh Portable Charger</div>
                <div class="description">20000mah Power Bank with 3 PowerIQ, 6A Output, Dual Input and 4A Fast Recharging</div>
            </a>
            <a class="item" href="#">
                <img src="<?php echo (C("IMG_URL")); ?>/product1.jpg" alt="">
                <div class="title">PowerCore II 20000mAh Portable Charger</div>
                <div class="description">20000mah Power Bank with 3 PowerIQ, 6A Output, Dual Input and 4A Fast Recharging</div>
            </a>
            <a class="item" href="#">
                <img src="<?php echo (C("IMG_URL")); ?>/product1.jpg" alt="">
                <div class="title">PowerCore II 20000mAh Portable Charger</div>
                <div class="description">20000mah Power Bank with 3 PowerIQ, 6A Output, Dual Input and 4A Fast Recharging</div>
            </a>
        </div>
        <div class="module-more">
            <a href="#">LOAD MORE</a>
        </div>
    </div>




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