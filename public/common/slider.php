<?php
include "../class/db.class.php";
$db = new DB();
if(isset($_REQUEST['slider'])){
    $data = $db->getAll('slider_pic',"*",'',"pic_order asc");
    if($data){
        //处理图片路径
        foreach($data as $k=>$v){
            if($v['pic_name']){
                $data[$k]['pic_name']="admin/public/Uploads/slider/".$v['pic_name'];
            }else{
                $data[$k]['pic_name']=$v['pic_url'];
            }
        }
    }
    echo json_encode($data);
}else{
    die("非法访问");
}
