<?php
header("content-type:text/html;charset=utf-8");
include "../../public/class/db.class.php";
$db = new DB();
//获取商品数据
//$data = $db->getAll('shop_goods',"*","type='buy'","id desc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>购在长寿湖</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="../../public/css/dropmenu.css" rel="stylesheet" type="text/css"/>
    <script src="../../public/js/jquery.min.js" type="text/javascript"></script>
    <script src="../../public/js/comm.js" type="text/javascript"></script>
    <script type="text/javascript">var submenu_style = 1;</script>
    <style>
        #buy_container{
            width:1000px;
            min-height:600px;
            margin: 10px auto;
            //background: gray;
        }
        #buy_top{
            height:35px;
            margin-bottom:5px;
            border:1px solid gray;
            border-radius:5px;
            background: lightslategrey;
            font-size:25px;
            font-weight:bold;
            font-family: 隶书;
            color:white;
            line-height:35px;
        }
        .buy_box{
            float:left;
            height:320px;
            width:324px;
            margin:5px 4px;
            background: #e0ecff;
            //margin-right:14px;
            padding-bottom:5px;
            padding-top:3px;
            border-radius:5px;

        }

        .buy_box  img{
            border:0;width:90%;height:180px;
            border-radius:4px;
        }

        .buy_box .gname{
            font-weight:bold;
            color:blue;
            font-size:16px;
        }
        .buy_box .ginfo {
            position: relative;
            height:40px;
            padding:4px;
            color:black;
            font-size:14px;
            text-align:left;
            text-indent:2em;
            overflow:hidden;
            //text-overflow:ellipsis;
            //white-space:nowrap;
        }
        p.ginfo::after {
            content: "...";
            font-weight: bold;
            position: absolute;
            bottom: 0;
            right: 0;
            /*padding:0 10px 1px 45px;
            background:url(http://css88.b0.upaiyun.com/css88/2014/09/ellipsis_bg.png) repeat-y;*/
        }
        .buy_box .gprice{
            color:brown;
            margin:10px auto;
        }
        .buy_box .buy_more{
            margin: 4px auto 0;
        }
    </style>

</head>
<body>
<!--引入公共头部-->
<?php include "../../public/common/header.php";?>

<div id="buy_container">
    <div id="buy_top">
        <marquee  direction="right" height="100%" width="30%"
                  scrollamount="2" scrolldelay="1"
                  behavior="alternate" >
            "购"在长寿湖
        </marquee>
    </div>

    <div class="buy_box">
        <img src="../../public/images/rmtj_pic.jpg"/>
        <div class="brief">
            <p class="gname">长寿湖血脐</p>
            <p class="ginfo">长寿湖血脐是一种非常好吃的水果，具有美艳功效，深受大家的喜欢深受大家的喜欢深受大家的喜欢深受大家的2222222222222222222深受大家的喜欢</p>
            <p class="gprice">非会员价格：5元/公斤 &nbsp;&nbsp; 会员价格：4元/公斤</p>
        </div>
        <div class="buy_more"><a class="morezx" href="detail.php?id=<?php echo "";?>">查看详情</a></div>
    </div>
    <div class="buy_box">
        <img src="../../public/images/rmtj_pic.jpg"/>
        <div class="brief">
            <p class="gname">长寿湖血脐</p>
            <p class="ginfo">长寿湖血脐是一种非常好吃的水果，具有美艳功效，深受大家的喜欢深受大家的喜欢深受大家的喜欢深受大家的2222222222222222222深受大家的喜欢</p>
            <p class="gprice">非会员价格：5元/公斤 &nbsp;&nbsp; 会员价格：4元/公斤</p>
        </div>
        <div class="buy_more"><a class="morezx" href="detail.php?id=<?php echo "";?>">查看详情</a></div>
    </div>
    <div class="buy_box">
        <img src="../../public/images/rmtj_pic.jpg"/>
        <div class="brief">
            <p class="gname">长寿湖血脐</p>
            <p class="ginfo">长寿湖血脐是一种非常好吃的水果，具有美艳功效，深受大家的喜欢深受大家的喜欢深受大家的喜欢深受大家的2222222222222222222深受大家的喜欢</p>
            <p class="gprice">非会员价格：5元/公斤 &nbsp;&nbsp; 会员价格：4元/公斤</p>
        </div>
        <div class="buy_more"><a class="morezx" href="detail.php?id=<?php echo "";?>">查看详情</a></div>
    </div>
    <div class="buy_box">
        <img src="../../public/images/rmtj_pic.jpg"/>
        <div class="brief">
            <p class="gname">长寿湖血脐</p>
            <p class="ginfo">长寿湖血脐是一种非常好吃的水果，具有美艳功效，深受大家的喜欢深受大家的喜欢深受大家的喜欢深受大家的2222222222222222222深受大家的喜欢</p>
            <p class="gprice">非会员价格：5元/公斤 &nbsp;&nbsp; 会员价格：4元/公斤</p>
        </div>
        <div class="buy_more"><a class="morezx" href="detail.php?id=<?php echo "";?>">查看详情</a></div>
    </div>
    <div class="buy_box">
        <img src="../../public/images/rmtj_pic.jpg"/>
        <div class="brief">
            <p class="gname">长寿湖血脐</p>
            <p class="ginfo">长寿湖血脐是一种非常好吃的水果，具有美艳功效，深受大家的喜欢深受大家的喜欢深受大家的喜欢深受大家的2222222222222222222深受大家的喜欢</p>
            <p class="gprice">非会员价格：5元/公斤 &nbsp;&nbsp; 会员价格：4元/公斤</p>
        </div>
        <div class="buy_more"><a class="morezx" href="detail.php?id=<?php echo "";?>">查看详情</a></div>
    </div>
    <div class="buy_box">
        <img src="../../public/images/rmtj_pic.jpg"/>
        <div class="brief">
            <p class="gname">长寿湖血脐</p>
            <p class="ginfo">长寿湖血脐是一种非常好吃的水果，具有美艳功效，深受大家的喜欢深受大家的喜欢深受大家的喜欢深受大家的2222222222222222222深受大家的喜欢</p>
            <p class="gprice">非会员价格：5元/公斤 &nbsp;&nbsp; 会员价格：4元/公斤</p>
        </div>
        <div class="buy_more"><a class="morezx" href="detail.php?id=<?php echo "";?>">查看详情</a></div>
    </div>

</div>

<!------------------------底部开始----------------------------->
<?php include "../../public/common/footer.php";?>
<!------------------------底部结束----------------------------->
</body>
</html>