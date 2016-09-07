<?php
header("content-type:text/html;charset=utf-8");
if(!isset($_REQUEST['id'])){die("非法访问！");}
include "../../public/class/db.class.php";
$db = new DB();
$goodsid = $_REQUEST['id'];
$basedata = $db->getOne('shop_goods',"*","id=$goodsid"); //商品基础数据
$sellerdata = $db->getOne('shop_seller',"*","id=".$basedata['sellerid']); //商品归属数据
$imagedata = $db->getAll("shop_image","*","pid=$goodsid"); //商品图片数据

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>商品详情</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="../../public/css/dropmenu.css" rel="stylesheet" type="text/css"/>
    <script src="../../public/js/jquery.min.js" type="text/javascript"></script>
    <script src="../../public/js/comm.js" type="text/javascript"></script>
    <script type="text/javascript">var submenu_style = 1;</script>
    <script src="../../public/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <style>
        #buy_detail{
            width:1000px;
            min-height:700px;
            margin: 10px auto;
            //background: gray;
        }
        #buy_top{
            float:left;
            height:200px;
            width:200px;
            background: lightslategrey;
            margin-bottom:5px;
            border:1px solid gray;
            border-radius:5px;
        }
        #buy_nav{
            height:30px;
            font-size:15px;
            line-height:30px;
            text-align: left;
            color:white;
            background: green;
        }

        #buy_top a{
            color:white;
        }
        #buy_top a:hover{
            text-decoration: none;
            color:lightblue;
        }
        #buy_detail .image{
            float:left;
            width:370px;
            height:320px;
            background: dimgrey;
            margin-right:10px;
            margin-left:10px;
            border-radius:4px;
        }
        #buy_detail .goods{
            float:right;
            width:400px;
            height:320px;
            background: lightgrey;
            border-radius:4px;
        }
        .goods table td{
            padding-left:10px;
        }
        .goods #buy_nums{
            width:40px;
            height:20px;
            border: 1px solid gray;
            border-radius:4px;
            padding-left:4px;
        }
        #addcart,#buythis{
            width:80px;
            height:25px;
            border:0;
            border-radius:4px;
            background: green;
            color:white;
            outline:none;
            cursor:pointer;
        }
        .tuwen{
            float:right;
            width:789px;
            min-height:600px;
            background:dimgrey;
            margin-bottom:20px;
            margin-top:10px;
            border-radius:4px;
            //border:1px solid gray;
            color:white;
        }
        .shop_info{
            font-size:15px;
            text-indent:2em;
            text-align:left;
            padding-left:5px;
        }
        .tuwen img{
            margin:10px auto;
            width:600px;
            height:400px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('#buythis').click(function(){
                var num = $('#buy_nums').val();
                var preg = /^[1-9][0-9]*$/; //匹配大于0的正整数
                if(!preg.test(num)){
                    alert("购买数量参数不合法，请填写正整数！");
                    return false;
                }
            });
        });
    </script>
</head>
<body>
<!--引入公共头部-->
<?php include "../../public/common/header.php";?>

<!--隐藏域-->
<input type="hidden" name="goodsid" value="<?php echo $goodsid;?>"/>

<div id="buy_detail">
    <div id="buy_top">
        <div id="buy_nav">
            <a href="./index.php">"购"在长寿湖</a> <b> > </b>
            <a href="javascript:void(o)">长寿湖血脐</a>
        </div>
    </div>

    <div class="image">
        <img src="../../admin/Public/Uploads/goods/<?php echo $basedata['showpic']?$basedata['showpic']:'default.jpg';?>"
             style="width:100%;height:100%;border-radius:4px;"/>
    </div>
    <div class="goods">
        <form action="../order.php" method="post">
            <table width="99%">
                <tr height="30">
                    <td align="right" width="150">品名：</td>
                    <td align="left" ><?php echo $basedata['gname'];?></td>
                </tr>
                <tr height="30">
                    <td align="right">产地：</td>
                    <td align="left"><?php echo $basedata['source'];?></td>
                </tr>
                <tr height="30">
                    <td align="right">非会员价格：</td>
                    <td align="left"><?php echo $basedata['price'];?></td>
                </tr>
                <tr height="30">
                    <td align="right">会员价格：</td>
                    <td align="left"><?php echo $basedata['userprice'];?></td>
                </tr>
                <tr height="30">
                    <td align="right">商家信息：</td>
                    <td align="left"><?php echo $sellerdata['shopname'];?></td>
                </tr>
                <tr height="30">
                    <td align="right">库存：</td>
                    <td align="left"><?php echo $basedata['total'];?></td>
                </tr>
                <tr height="30">
                    <td align="right">购买数量：</td>
                    <td align="left">
                        <input name="buy_nums" id="buy_nums" value="1"/>
                        <input name="goodsid" type="hidden" value="<?php echo $goodsid;?>">
                        <input name="gname" type="hidden" value="<?php echo $basedata['gname'];?>">
                        <input name="gprice" type="hidden" value="<?php echo isset($_SESSION['username'])?$basedata['userprice']:$basedata['price'];?>">
                        <input name="sellerid" type="hidden" value="<?php echo $sellerdata['id'];?>">
                    </td>
                </tr>
                <tr height="90">
                    <td align="right" valign="bottom">
                        <button id="addcart">加入购物车</button>
                    </td>
                    <td valign="bottom">
                        <button id="buythis">购买</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="tuwen">
        <p class="shop_info">
           <?php echo $basedata['content'];?>
        </p>
        <?php if($imagedata){foreach($imagedata as $k=>$v){ ?>
        <img src="../../admin/Public/Uploads/goods_more/<?php echo $v['iname'];?>"/>
        <?php }}?>
    </div>
</div>

<!------------------------底部开始----------------------------->
<?php include "../../public/common/footer.php";?>
<!------------------------底部结束----------------------------->
</body>
</html>