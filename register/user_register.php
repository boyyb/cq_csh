<?php
//后台暂时不做数据合法性验证，全部由前端js完成！！
header("content-type:text/html;charset=utf-8");
session_start();
if(isset($_REQUEST)){
    require_once "../public/class/db.class.php";
    $db = new DB();

    //核对用户名重复问题
    if(@$_REQUEST['action'] == "checkuser"){
        $username = $_REQUEST['username'];
        $data = $db -> getOne('user',"*","username='$username'");
        if($data){
            echo "1";
        }else{
            echo "0";
        }
        die;
    }

    //验证码核对
    $vcode_session = $_SESSION['authnum_session'];
    $vcode_input = $_REQUEST['vcode'];
    if($vcode_session != $vcode_input){
        die("vcode_error");
    }
   //写入数据到数据库中
    $_REQUEST['reg_time']=time();
    $data = $db -> create('user',$_REQUEST);
    $db -> add('user',$data);
    if($db -> getLastId()){
        echo "1";
    }else{
        echo "0";
    }
}else{
    die("非法访问！");
}
