<?php
header("content-type:text/html;charset=utf-8");
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
    }else{
        echo "ok";//返回ajax
        //处理session

    }
}else{
    die("非法访问！");
}
