<?php
//后台暂时不做数据合法性验证，全部由前端js完成！！
header("content-type:text/html;charset=utf-8");
session_start();
if(isset($_REQUEST)){
    require_once "../public/class/db.class.php";
    $db = new DB();

}else{
    die("非法访问！");
}
