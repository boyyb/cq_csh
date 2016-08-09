
<?php
$url = $_SERVER['PHP_SELF'];
if($url == "/1_csh/index1.php"){
    $flag = "mainPage";
}
echo $flag;
?>

<!-------------------------顶部开始--------------------------->
<div class="top_box">
    <div class="top_box_inner">
        <div class="logo"></div>
        <div class="topcontent">
            <span class="top-l">欢迎光临长寿湖旅游网站!</span>
                <span class="top-r">
                    <a href="./login/">登陆</a>
                    <a href="./register/">注册</a>
                </span>
        </div>
        <div class="clear"></div>
        <!------------------------顶部结束----------------------------->
        <!------------------------导航栏开始----------------------------->
        <div class="menu_box" id="Menu">
            <ul>
                <li class="menu_style <?php if($flag=="mainPage")echo "menu_current";?>" id="MenuItem61" name="MenuItem"><a href="http://localhost/1_csh/index1.php" class="menu">网站首页</a></li>
                <li class="menu_style" id="MenuItem62" name="MenuItem"><a href="http://localhost/1_csh/jqjs/" class="menu">景区介绍</a></li>
                <li class="menu_style" id="MenuItem63" name="MenuItem"><a href="http://localhost/1_csh/jqzx/" class="menu">景区资讯</a></li>
                <li class="menu_style" id="MenuItem64" name="MenuItem"><a href="javascript:void(0)" class="menu">吃·住·玩·购</a>
                    <ul>
                        <li><a href="http://localhost/1_csh/czwg/eat">"吃"在长寿湖</a></li>
                        <li><a href="http://localhost/1_csh/czwg/live">"住"在长寿湖</a></li>
                        <li><a href="http://localhost/1_csh/czwg/play">"玩"在长寿湖</a></li>
                        <li><a href="http://localhost/1_csh/czwg/buy">"购"在长寿湖</a></li>
                    </ul>
                </li>
                <li class="menu_style" id="MenuItem65" name="MenuItem"><a href="http://localhost/1_csh/zxly/" class="menu">在线留言</a></li>
                <li class="menu_style" id="MenuItem66" name="MenuItem"><a href="http://localhost/1_csh/lxwm/" class="menu">联系我们</a></li>
            </ul>
        </div>
    </div>
</div>
<!--显示二级菜单-->
<script type="text/javascript">var IsPageHome = "1";var Lanmu_Id = "61";var Sublanmu_Id = "0";ShowSubMenu(Lanmu_Id);</script>
<!------------------------导航栏结束----------------------------->