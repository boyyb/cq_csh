<?php
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");


if(isset($_REQUEST)){
    require_once "../public/class/db.class.php";
    $db = new DB();
    $cstart = $_REQUEST['cnum'];
    $csize = 10;
    $pid = $_REQUEST['pid'];
    $data = $db->getAll("news_comment","*","pid=$pid","id desc","$cstart,$csize");
    foreach($data as $k=>$v){
        $data[$k]['time']=date("Y-m-d H:i:s",$v['time']);
    }
    if(!$data){die;}
    $total = count($data);
    $ret['count']=$total;
    $ret['data']=$data;
    echo json_encode($ret);


}else{
    die("非法访问！");
}
