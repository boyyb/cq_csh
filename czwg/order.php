<?php
header("content-type:text/html;charset=utf-8");
//if(!isset($_REQUEST['id'])){die("非法访问！");}
include "../public/class/db.class.php";
$db = new DB();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>订单详情</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script src="../public/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <style>
        #submit,#back{
            width:80px;
            height:25px;
            border:0;
            border-radius:4px;
            background: green;
            color:white;
            outline:none;
            cursor:pointer;
            margin-right:10%;

        }
        input[name=saddress],input[name=baddress]{
            width:500px;
        }
        table{
            border-collapse: collapse;
        }
        td{
            border:1px solid gray;
        }
        table input{
            padding-left:4px;
        }
    </style>
    <script>
        $(document).ready(function(){

            $('#back').click(function(){
                window.location.href=document.referrer;
            });
        });
    </script>
</head>
<body>
<table  width="70%" align="center">
    <tr>
        <td colspan="3" align="center" style="background: lightgrey">订单信息</td>
    </tr>
    <tr height="25">
        <td colspan="3">卖家信息</td>
    </tr>
    <tr height="25">
        <td align="right" width="150">姓名</td>
        <td>
            <input name="sname"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right">联系方式</td>
        <td>
            <input name="sphone"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right">邮编</td>
        <td>
            <input name="spostcode"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right">联系地址</td>
        <td>
            <input name="saddress"/>
        </td>
    </tr>
    <tr height="25">
        <td colspan="3">买家信息</td>
    </tr>
    <tr height="25">
        <td align="right"><b style="color:red">*</b>姓名</td>
        <td>
            <input name="bname"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right"><b style="color:red">*</b>联系方式</td>
        <td>
            <input name="bphone"/>
        </td>

    </tr>
    <tr height="25">
        <td align="right">邮编</td>
        <td>
            <input name="bpostcode"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right"><b style="color:red">*</b>联系地址</td>
        <td>
            <input name="baddress"/>
        </td>
    </tr>
    <tr height="25">
        <td colspan="3">商品信息</td>
    </tr>
    <tr height="25">
        <td align="right">名称</td>
        <td>
            <input name="shop_name"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right">数量</td>
        <td>
            <input name="shop_num"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right">价格</td>
        <td>
            <input name="shop_price"/>
        </td>
    </tr>
    <tr height="25">
        <td align="right">总价</td>
        <td>
            <input name="price_sum"/>元
        </td>
    </tr>
    <tr height="25">
        <td align="right">邮编</td>
        <td>
            <input name="bpostcode"/>
        </td>
    </tr>

    <tr>
        <td colspan="3" align="center">
            <button id="submit">提交订单</button>
            <button id="back">返回</button>
        </td>
    </tr>
</table>


</html>