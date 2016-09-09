<?php
session_start();
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");
//if(!isset($_REQUEST){die("非法访问！");}
include "../public/class/db.class.php";
$db = new DB();
//保存买家信息
$db->add("shop_buyer",array(
    "bname"=>$_REQUEST['bname'],
    "phone"=>$_REQUEST['bphone'],
    "postcode"=>$_REQUEST['bpostcode'],
    "address"=>$_REQUEST['baddress']
));
//保存订单数据
$ordernum = $_REQUEST["ordernum"];
$_REQUEST['state'] = "未付款";
$_REQUEST['time'] = time();
$_REQUEST['username'] = $_SESSION['username'];
$dataarr = $db->create("shop_order",$_REQUEST);
$res = $db->getOne("shop_order","*","ordernum='$ordernum'");
if(!$res){
    $db -> add("shop_order",$dataarr);
    if(!$db->getLastId()){
        die("订单生成失败！");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>支付</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script src="../public/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <style>
        .back{
            display: block;
            width:80px;
            height:25px;
            line-height:25px;
            color:white;
            background: green;
            text-decoration: none;
            text-align: center;
        }
        
    </style>
    <script>
        $(document).ready(function(){

        });
    </script>
</head>
<body>
<p><a class="back" href="../index1.php">返回主页</a></p>
<table width="1000" align="center"
       style="background: whitesmoke;font-size:14px;color:royalblue;border-collapse: collapse;margin-top:80px;" border="1">
    <tr style="background:seagreen;color:white;">
        <td width="300">订单号：<?php echo $_REQUEST['ordernum'];?></td>
        <td width="350">状态：<?php echo $_REQUEST['state'];?></td>
        <td  align="right">下单时间：<?php echo date("Y-m-d H:i:s",$_REQUEST['time']);?></td>
    </tr>
    <tr>
        <td>商品名称：<b><?php echo $_REQUEST['gname'];?></b></td>
        <td>店铺名称：<?php echo $_REQUEST['shopname'];?></td>
        <td>
            数量：<?php echo $_REQUEST['number'];?> &nbsp;&nbsp;
            价格：<?php echo $_REQUEST['price'];?> &nbsp;&nbsp;
            总价：<?php echo $_REQUEST['totalprice'];?>元
        </td>
    </tr>
    <tr>
        <td>收货人：<?php echo $_REQUEST['bname'];?></td>
        <td>电话：<?php echo $_REQUEST['bphone'];?></td>
        <td>邮编：<?php echo $_REQUEST['bpostcode'];?></td>
    </tr>
    <tr>
        <td colspan="3">收货地址：<?php echo $_REQUEST['baddress'];?></td>
    </tr>
    <tr height="40">
        <td colspan="3" align="center">
            <button>付款</button>
        </td>
    </tr>

</table>


</html>