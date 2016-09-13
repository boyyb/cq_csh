<?php
header('content-type:text/html;charset=utf-8');
if(!isset($_REQUEST)){die("非法链接！");}
include "../public/class/db.class.php";
$db = new DB();
function download($file,$filename){ //下载的文件 和 下载时的文件名
    $file = iconv('UTF-8', 'GB2312', $file);//针对中文，还原gb2312编码
    if(is_file($file)) {

        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=$filename");
        readfile($file);
    }else{
        //echo "<script>alert('文件不存在！');</script>";
        echo "文件不存在";
        die;
    }
}

if(isset($_REQUEST) && @$_REQUEST['dl']){
    $file="../admin/Public/Downloads/".$_REQUEST['filename'];
    $filename = $_REQUEST['filename'];
    $id = $_REQUEST['id'];
    download($file,$filename);
    $db->execSql("UPDATE file_download SET COUNT=COUNT+1 WHERE id=$id");
}

/*if(isset($_REQUEST) && @$_REQUEST['see']){
    $link="../admin/Public/Downloads/".$_REQUEST['filename'];
    if (isset($link))
    {
        header('content-type:text/html;charset=utf-8');
        Header("HTTP/1.1 303 See Other");
        Header("Location: $link");
        exit;
    }
}*/

