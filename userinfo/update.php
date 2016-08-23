<?php
//后台暂时不做数据合法性验证，全部由前端js完成！！
header("content-type:text/html;charset=utf-8");
session_start();
if(isset($_REQUEST)){
    require_once "../public/class/db.class.php";
    $db = new DB();
    $id = $_REQUEST['id'];
    //更改密码
    if(isset($_POST['opwd'])){
        $opwd = $_REQUEST['opwd'];
        $npwd = $_REQUEST['npwd'];
        $data = $db->getOne('user',"*","id=$id and password='$opwd'");
        if(!$data){
            die("opwd_error");
        }
        $db->update('user',array("password"=>$npwd),"id=$id");
        if($db->getAffectedRows()){
            echo "ok";
        }else{
            echo "fail";
        }

        die;
    }

    $data = $db->create('user',$_REQUEST);
    $db->update('user', $data,"id=$id");
    $num = $db->getAffectedRows();
    if($num){
        $ret['state'] = "ok";
    }else{
        $ret['state'] = "fail";
    }
    $ret['affectrows'] = $num;

    echo json_encode($ret);

}else{
    die("非法访问！");
}
