<?php
header('content-type:text/html;charset=utf-8');
if(!isset($_REQUEST)){die("非法链接！");}
include "../public/class/db.class.php";
$db = new DB();
$data = array(
    "nickname"=>$_REQUEST['nickname'],
    "time"=>$_REQUEST['time'],
    "times"=>$_REQUEST['times']
);
