<?php
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");

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
    $ip = get_client_ip();
    $pid = $_REQUEST['pid'];
    $data = $db->getOne("news_like","*","ip='$ip' and pid=$pid");
    //统计
    if(isset($_REQUEST['tongji'])){
        $arr = $db->getAll("news_like","*","nlike='1' and pid=$pid");
        $like = count($arr);
        $arr2 = $db->getAll("news_like","*","nlike='0' and pid=$pid");
        $unlike = count($arr2);
        $ret['like']=$like;
        $ret['unlike']=$unlike;
        echo json_encode($ret);
        die;
    }

    if($data){
        if($data['nlike']=='1'){
            echo json_encode(array("info"=>"like+1"));die;
        }
        if($data['nlike']=='0'){
            echo json_encode(array("info"=>"unlike+1"));die;
        }
    }
    if(isset($_REQUEST['like'])){
        $db->add('news_like',array("ip"=>$ip,"pid"=>$pid,"nlike"=>1));
        $res = $db->getLastId();
        $arr = $db->getAll("news_like","*","nlike='1' and pid=$pid");//获顶总数
        $like = count($arr);
        if($res){
            echo json_encode(array("like"=>$like,"info"=>"ok"));
        }else{
            echo json_encode(array("info"=>"fail"));
        }
    }
    elseif(isset($_REQUEST['unlike'])){
        $db->add('news_like',array("ip"=>$ip,"pid"=>$pid,"nlike"=>0));
        $res = $db->getLastId();
        $arr = $db->getAll("news_like","*","nlike='0' and pid=$pid");//获踩总数
        $unlike = count($arr);
        if($res){
            echo json_encode(array("unlike"=>$unlike,"info"=>"ok"));
        }else{
            echo json_encode(array("info"=>"fail"));
        }
    }




}else{
    die("非法访问！");
}
