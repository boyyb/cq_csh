<?php
header("content-type:text/html;charset=utf-8");
session_start();
if(isset($_REQUEST)){
    require_once "../public/class/db.class.php";
    $db = new DB();

    //检查用户名和密码
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    //检查用户是否存在
    $res = $db -> getOne("user","*","username='$username'");
    if(!$res){
        die("user_ne");
    }
    $res = $db -> getOne("user","*","username='$username' and password='$password'");
    if(!$res){
        die("pwd_error");
    }
    if($res['state']=="0"){
        echo "lock";//返回ajax
    }else{
        echo "ok";//返回ajax
        //处理session
        $_SESSION['username']=$username;
    }
}else{
    die("非法访问！");
}
