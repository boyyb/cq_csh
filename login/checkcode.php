<?php
header("content-type:text/html;charset=utf-8");
session_start();
if(isset($_POST) && $_POST){
    require_once "../public/class/db.class.php";
    $db = new DB();
    $code = $_REQUEST['token'];
    $pwd = $_REQUEST['password'];
    $cpwd = $_REQUEST['cpassword'];
    $username = @$_SESSION['username'];
    if(!$code || !$pwd || !$cpwd){
        die("数据填写不完整!<a href='forgetpwd.php'>返回</a>");
    }
    if($code != @$_SESSION['usercode']){
        die("校验码错误!<a href='forgetpwd.php'>返回</a>");
    }
    if(strlen($pwd)<6){
        die("密码不小于6位数!<a href='forgetpwd.php'>返回</a>");
    }
    if($pwd != $cpwd){
        die("两次输入的密码不一致!<a href='forgetpwd.php'>返回</a>");
    }

    $db -> update("user",array("password"=>$pwd),"username='$username'");

    if($db->getAffectedRows()){
        echo "<script>alert('重置密码成功！');</script>";
        echo "<a href='index.html'>返回登陆页</a>";

    }else{
        echo "<script>alert('重置密码失败！');</script>";
        echo "<a href='forgetpwd.php'>返回上一页</a>";
    }
}else{
    die("非法访问！");
}
