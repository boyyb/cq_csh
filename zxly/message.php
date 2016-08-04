<?php
header('content-type:text/html;charset=utf-8');
//省略了后端对数据的验证，后期再加上
if(isset($_REQUEST)){
    require '../public/class/db.class.php';
    $db = new DB();
    $_REQUEST['time'] = time();
    $db -> add('message',$_REQUEST);
    if($db->getLastId()){
        echo 'ok';
    }else{
        echo 'fail';
    }
}else{
    echo "非法访问！";
}