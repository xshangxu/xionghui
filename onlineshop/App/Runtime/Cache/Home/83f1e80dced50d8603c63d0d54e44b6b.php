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
    
    <div class="type">
        <?php if(is_array($infoType)): foreach($infoType as $key=>$v): ?><a href="/index.php/Home/Goods/goodslist/cat_id/<?php echo ($v["cat_id"]); ?>"><?php echo ($v["cat_name"]); ?></a><?php endforeach; endif; ?>
        <!--<a href="" class="type_active">BNC adapter</a>-->
    </div>
    <div class="product">
        <div class="module_items">
            <?php if(is_array($info)): foreach($info as $key=>$vv): ?><a class="item" href="<?php echo (C("HOME_URL")); ?>/Goods/details/goods_id/<?php echo ($vv["goods_id"]); ?>">
                    <img src="<?php echo (C("REALM_URL")); echo ($vv["goods_thumb"]); ?>" alt="">
                    <div class="title"><?php echo ($vv["goods_name"]); ?></div>
                    <div class="description"><?php echo ($vv["goods_brief"]); ?></div>
                </a><?php endforeach; endif; ?>
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