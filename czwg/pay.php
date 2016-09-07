<?php
header("content-type:text/html;charset=utf-8");
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
$_REQUEST["ordernum"] = "c_".date("YmdHis",time()).time().rand(1000,9999);
$_REQUEST['state'] = "未付款";
$_REQUEST['time'] = time();
$dataarr = $db->create("shop_order",$_REQUEST); var_dump($dataarr);die;
$db -> add("shop_order",$dataarr);
if(!$db->getLastId()){
    die("订单生成失败！");
}



var_dump($_REQUEST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>支付</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script src="../public/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <style>

    </style>
    <script>
        $(document).ready(function(){


        });
    </script>
</head>
<body>
<table width="1000" align="center" style="background: whitesmoke;font-size:14px;color:royalblue;border-collapse: collapse;" border="1">
    <tr style="background:seagreen;color:white;">
        <td width="300">订单号：{$v.ordernum}</td>
        <td width="380">状态：{$v.state}</td>
        <td width="350" align="right">下单时间：{$v.time|date="Y-m-d H：i",###}</td>
    </tr>
    <tr>
        <td>商品名称：<b>{$v.gname}</b></td>
        <td>店铺名称：{$v.shopname}</td>
        <td>
            数量：{$v.number} &nbsp;&nbsp;
            价格：{$v.price} &nbsp;&nbsp;
            总价：{$v.totalprice}
        </td>
    </tr>
    <tr>
        <td>收货人：{$v.bname}</td>
        <td>电话：{$v.bphone}</td>
        <td>邮编：{$v.postcode}</td>
    </tr>
    <tr>
        <td>商品id：{$v.goodsid}</td>
        <td colspan="2">收货地址：{$v.baddress}</td>
    </tr>

</table>


</html>