<?php
//利用mongodb存储留言的数据
require_once('function.php');  //函数调用文件
if(isset($_POST['saytxt'])){
    $m = new MongoClient();    // 连接到mongodb
    $db = $m->csh;            // 选择一个数据库
    $collection = $db->message;   // 选择集合

    $ip = getIp();
    $ipdata = getInfoByIp($ip);
    if(!$ipdata){
        $location = "";
    }else{
        $location = $ipdata['country'].$ipdata['region'].$ipdata['city'];
    }


    $txt=stripslashes($_POST['saytxt']); //删除反斜杠
    $txt=strip_tags($txt); //过滤HTML标签，
    $txt=htmlspecialchars($txt);//转义html实体，转义特殊字符
    if(mb_strlen($txt,"utf-8")<1 || mb_strlen($txt,"utf-8")>140)
        die("0"); //判断输入字符数是否符合要求
    $time=time(); //获取当前时间
    $userid=rand(0,4);

    //插入数据到集合中
    //$db->execSql("insert into say(userid,content,addtime,ip,location) values ('$userid','$txt','$time','$ip','$location')");
    $dataArr=array(
        "userid"=>$userid,
        "content"=>$txt,
        "addtime"=>$time,
        "ip"=>$ip,
        "location"=>$location
    );
    $res = $collection->insert($dataArr);
    if(!$res){
        die("0");//插入数据失败
    }

    echo formatSay($txt,$time,$userid,$location); //调用函数输出结果
}else{
    die("非法访问！");
}
