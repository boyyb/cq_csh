<?php
header("content-type:text/html;charset=utf-8");
//if(!isset($_REQUEST){die("非法访问！");}
include "../public/class/db.class.php";
$db = new DB();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>购物车</title>
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



</html>