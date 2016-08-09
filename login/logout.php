<?php
header("content-type:text/html;charset=utf-8");
session_start();
if(isset($_REQUEST)){
    unset($_SESSION['username']);
    session_destroy();
    $url = $_SERVER['HTTP_REFERER'];
    header("location:$url");
}else{
    die("非法访问！");
}
