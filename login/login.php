<?php
header("content-type:text/html;charset=utf-8");
session_start();
function get_client_ip(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
        $ip = getenv("HTTP_CLIENT_IP");
    }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
        $ip = getenv("REMOTE_ADDR");
    }else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
        $ip = $_SERVER['REMOTE_ADDR'];
    }else{
        $ip = "unknown";

    }
    return($ip);
}
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
        //记录登陆数据
        $pid = $res['id'];
        $login_time=time();
        $login_ip=get_client_ip();
        $db->add('user_login',array("pid"=>$pid,"login_time"=>$login_time,"login_ip"=>$login_ip));
        //处理session
        $_SESSION['username']=$username;
    }
}else{
    die("非法访问！");
}
