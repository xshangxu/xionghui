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
    <link rel="stylesheet" href="<?php echo (C("CSS_URL")); ?>/goods.css">
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>/goods.js"></script>

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
    
    <div class="crumbs">
        <div class="wrapper">
            <a href="/">Home</a>
            <span class="split">/</span>
            <a href="/products">products</a>
            <span class="split">/</span>
            <a href="/products/taxons/107/Batteries">Batteries</a>
            <span class="split">/</span>
            <span class="cur"><?php echo ($info["goods_name"]); ?></span>
        </div>
    </div>

    <div class="product_view">
        <div class="carousel">
            <div class="carousel_image">
                <?php if(is_array($newPic)): foreach($newPic as $key=>$v): ?><img src="<?php echo (C("REALM_URL")); echo ($v["middle_img"]); ?>" alt=""><?php endforeach; endif; ?>
            </div>
            <div class="carousel_images">
                <a href="javascript:;" class="ctrl product_prev">&lt;</a>
                <a href="javascript:;" class="ctrl product_next">&gt;</a>
                <div class="carousel_page">
                    <ul>
                        <!--<li><img class="img_active carousel_img" src="<?php echo (C("IMG_URL")); ?>/product1_s1" alt=""></li>-->
                        <?php if(is_array($newPic)): foreach($newPic as $key=>$vv): ?><li><img class="carousel_img" src="<?php echo (C("REALM_URL")); echo ($vv["small_img"]); ?>" alt=""></li><?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="information">
            <div class="info_title"><?php echo ($info["goods_name"]); ?></div>
            <div class="info_desc"><?php echo ($info["goods_brief"]); ?></div>
            <div class="price">$<?php echo ($info["shop_price"]); ?></div>
            <form action="">
                <!--<div class="info_color">-->
                    <!--<p class="info_p">Color:</p>-->
                    <!--<a href="javascript:;" class="color color_selected">黑色<input type="radio" name="color"></a>-->
                    <!--<a href="javascript:;" class="color">红色<input type="radio" name="color"></a>-->
                <!--</div>-->
                <div class="info_num">
                    <p class="info_p">Quantity:</p>
                    <div>
                        <a href="javascript:;" class="reduce_l">-</a>
                        <input class="number" type="text" name="number" value="1" >
                        <a href="javascript:;" class="add_r">+</a>
                    </div>
                </div>
                <a href="javascript:;" class="info_btn store">ADD TO CART</a>
                <a href="<?php echo ($info["goods_link"]); ?>" class="info_btn amazon">BUY AT AMAZON US</a>
            </form>
        </div>
    </div>

    <!-- 产品特点 -->
    <div class="prod_fea">
        <div>Features</div>
        <ul>
           <?php if(is_array($info["goods_desc"])): foreach($info["goods_desc"] as $key=>$v): ?><li><?php echo ($v); ?></li><?php endforeach; endif; ?>
        </ul>
    </div>

    <!-- 产品套餐内容 -->
    <div class="prod_pack">
        <div>Package included</div>
        <p><?php echo ($info["goods_package"]); ?></p>
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