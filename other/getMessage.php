<?php
//利用mongodb读取留言的数据
require_once('function.php');  //函数调用文件
if(isset($_POST)){
    $m = new MongoClient();    // 连接到mongodb
    $db = $m->csh;            // 选择一个数据库
    $collection = $db->message;   // 选择集合

    $cursor = $collection->find()->sort(array("addtime"=>-1));//按照添加时间降序排序
    $str = '';
    foreach ($cursor as $id => $value) {
        $str .= formatSay($value['content'],$value['addtime'],$value['userid'],$value['location']);
    }


    echo $str; //调用函数输出结果
}else{
    die("非法访问！");
}
