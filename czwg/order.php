<?php
header("content-type:text/html;charset=utf-8");
//if(!isset($_REQUEST['goodsid'])){die("非法访问！");}
include "../public/class/db.class.php";
$db = new DB();
$goodsid = @$_REQUEST['goodsid'];
$gprice = @$_REQUEST['gprice'];
$gname = @$_REQUEST['gname'];
$sellerid = @$_REQUEST['sellerid'];
$num = @$_REQUEST['buy_nums'];
$total = (float)$gprice * $num;

$sdata = $db->getOne("shop_seller","*","id=$sellerid");//卖家信息

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

            //正则处理商品数量
            $('input[name=number]').bind("blur focus keydown keypress keyup",function(){
                var num = $(this).val();
                var preg = /^[1-9][0-9]*$/; //匹配大于0的正整数
                if(!preg.test(num)){
                    alert("购买数量不合法，请填写正整数！");
                    $(this).val("1");//赋默认值1
                    return false;
                }
            });

            $('#less').click(function(){
                var num = $('input[name=number]').val();
                if(num>1){
                    num--;
                    $('input[name=number]').val(num);
                }
                countTotal();
            });
            $('#more').click(function(){
                var num = $('input[name=number]').val();
                num++;
                $('input[name=number]').val(num);
                countTotal();
            });

            //提交
            $('#submit').click(function(){
                var name = $('input[name=bname]').val();
                var phone = $('input[name=bphone]').val();
                var address = $('input[name=baddress]').val();

                if(!name || !phone || !address){
                    alert("带\"*\"号为必填项！");
                    return false;
                }
            });

        });
        function countTotal(){
            var price = $('input[name=price]').val()*1;
            var number = $('input[name=number]').val()*1;
            var total = price*number;
            $('input[name=totalprice]').val(total);
        }
    </script>
</head>
<body>
<form action="pay.php" method="post">
    <table  width="70%" align="center">
        <tr>
            <td colspan="3" align="center" style="background: lightgrey">订单信息</td>
        </tr>
        <tr height="25">
            <td colspan="3">卖家信息</td>
        </tr>
        <tr height="25">
            <td align="right" width="150">商铺名称</td>
            <td>
                <input name="shopname" readonly value="<?php echo $sdata['shopname']?>"/>
                <input type="hidden" name="sellerid" value="<?php echo $sellerid;?>">
            </td>
        </tr>
        <tr height="25">
            <td align="right" width="150">姓名</td>
            <td>
                <input name="sname" readonly value="<?php echo $sdata['sname']?>"/>
            </td>
        </tr>
        <tr height="25">
            <td align="right">联系方式</td>
            <td>
                <input name="sphone" readonly value="<?php echo $sdata['phone']?>"/>
            </td>
        </tr>
        <tr height="25">
            <td align="right">邮编</td>
            <td>
                <input name="spostcode" readonly value="<?php echo $sdata['postcode']?>"/>
            </td>
        </tr>
        <tr height="25">
            <td align="right">联系地址</td>
            <td>
                <input name="saddress" readonly value="<?php echo $sdata['address']?>"/>
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
                <input name="gname" readonly value="<?php echo $gname?>"/>
                <input type="hidden" name="goodsid" value="<?php echo $goodsid;?>"/>
                <input type="hidden" name="ordernum" value="<?php echo "c_".date("YmdHis",time()).time().rand(1000,9999);?>">
            </td>
        </tr>
        <tr height="25">
            <td align="right">数量</td>
            <td>
                <input name="number" value="<?php echo $num;?>"/>
                <button type="button" id="less">减少</button>
                <button type="button" id="more">增加</button>
            </td>
        </tr>
        <tr height="25">
            <td align="right">价格</td>
            <td>
                <input name="price" readonly value="<?php echo $gprice;?>"/>元
            </td>
        </tr>
        <tr height="25">
            <td align="right">总价</td>
            <td>
                <input name="totalprice" readonly value="<?php echo $total;?>"/>元
            </td>
        </tr>

        <tr height="50">
            <td colspan="3" align="center">
                <button id="submit">提交订单</button>
                <button type="button" id="back">返回</button>
            </td>
        </tr>
    </table>
</form>



</html>