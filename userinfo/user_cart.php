<?php
session_start();
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");
include "../public/class/db.class.php";
$db = new DB();

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $dataArr = $db->getAll("shop_order","*","username='$username'","id desc");
    if(!$dataArr){
        die("没有订单数据！");
    }
}elseif(isset($_POST['ordernum']) && $_POST['ordernum']){
    $ordernum = $_POST['ordernum'];
    $dataArr = $db->getAll("shop_order","*","ordernum='$ordernum'","id desc");
    if(!$dataArr){
        die("没有订单数据！");
    }
}
//var_dump($dataArr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>购物车</title>
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
            $('input[type=submit]').click(function(){
                if(!$('input[name=ordernum]').val()){
                    alert("订单号为空！");
                    return false;
                }
            });
        });
    </script>
</head>
<body>
<p><a class="back" href="../index1.php">返回主页</a></p>
<?php if(!isset($_SESSION['username'])){ ?>
<form action="" method="post">
    <p>订单号：<input name="ordernum"/><input type="submit" /></p>
</form>
<?php } ?>
<?php  if(isset($dataArr)){foreach($dataArr as $k=>$v){  ?>
<table width="1000" align="center"
       style="background: whitesmoke;font-size:14px;color:royalblue;border-collapse: collapse;margin-top:80px;" border="1">
    <tr style="background:seagreen;color:white;">
        <td width="350">订单号：<?php echo $v['ordernum'];?></td>
        <td width="300">状态：<?php echo $v['state'];?></td>
        <td  align="right">下单时间：<?php echo date("Y-m-d H:i:s",$v['time']);?></td>
    </tr>
    <tr>
        <td>商品名称：<b><?php echo $v['gname'];?></b></td>
        <td>店铺名称：<?php echo $v['shopname'];?></td>
        <td>
            数量：<?php echo $v['number'];?> &nbsp;&nbsp;
            价格：<?php echo $v['price'];?> &nbsp;&nbsp;
            总价：<?php echo $v['totalprice'];?>元
        </td>
    </tr>
    <tr>
        <td>收货人：<?php echo $v['bname'];?></td>
        <td>电话：<?php echo $v['bphone'];?></td>
        <td>邮编：<?php echo $v['bpostcode'];?></td>
    </tr>
    <tr>
        <td colspan="3">收货地址：<?php echo $v['baddress'];?></td>
    </tr>
    <tr height="40">
        <td colspan="3" align="center">
            <button>付款</button>
        </td>
    </tr>
</table>
<?php }} ?>

</html>