
<!DOCTYPE html>
<html lang="en">
<head>
    <title>联系我们</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="../public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="../public/css/dropmenu.css" rel="stylesheet" type="text/css"/>
    <script src="../public/js/jquery.min.js" type="text/javascript"></script>
    <script src="../public/js/comm.js" type="text/javascript"></script>
    <script type="text/javascript">var submenu_style = 1;</script>
</head>
<body>
<!--引入公共头部-->
<?php include "../public/common/header.php";?>
<div id="lxwm_container">
    <div id="lxwm_banner">
        <img width="100%" height="100%" src="../public/images/lxwm/banner.png">
    </div>
    <div id="lxwm_info">
        <img width="100%" height="100" src="../public/images/lxwm/cshlogo.jpg">
        <p>联系人：大坪岛主</p>
        <p>联系电话：13629795255</p>
        <p>邮箱：619280492@qq.com</p>
        <p>QQ：619280492</p>
        <p class="lxwm_addr">地址：重庆市南岸区青龙路金阳·罗马假日10栋2408号</p>
    </div>
    <div id="lxwm_map">
        <!--百度地图容器-->
        <div style="width:697px;height:400px;border:#ccc solid 1px;" id="dituContent"></div>
    </div>
    <div class="clear"></div>
</div>

<!------------------------底部开始----------------------------->
<?php include "../public/common/footer.php";?>
<!------------------------底部结束----------------------------->
<!--引入百度地图-->
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript" src="../public/js/lxwm_baiduMap.js"></script>
</body>
</html>


