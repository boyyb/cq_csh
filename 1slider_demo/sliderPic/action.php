<?php
error_reporting(0);
//生成缩略图
function img_create_small($big_img, $width, $height, $small_img) {//原始大图地址，缩略图宽度，高度，缩略图地址
    $imgage = getimagesize($big_img); //得到原始大图片
    switch ($imgage[2]) { // 图像类型判断
        case 1:
            $im = imagecreatefromgif($big_img);
            break;
        case 2:
            $im = imagecreatefromjpeg($big_img);
            break;
        case 3:
            $im = imagecreatefrompng($big_img);
            break;
    }
    $src_W = $imgage[0]; //获取大图片宽度
    $src_H = $imgage[1]; //获取大图片高度
    $tn = imagecreatetruecolor($width, $height); //创建缩略图
    imagecopyresampled($tn, $im, 0, 0, 0, 0, $width, $height, $src_W, $src_H); //复制图像并改变大小
    imagejpeg($tn, $small_img); //输出图像
}


$uptypes=array(
    'image/jpg',
    'image/jpeg',
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'image/x-png'
);
$max_file_size=2000000;	 //上传文件大小限制2m, 单位BYTE
$destination_folder="./pic/"; //上传文件目录
$imgpreview=1;	  //是否生成预览图(1为生成,其他为不生成);

if(isset($_FILES['pic_local1']) && $_FILES['pic_local1']){
    $picArr = $_FILES["pic_local1"];
}
if(isset($_FILES['pic_local2']) && $_FILES['pic_local2']){
    $picArr = $_FILES["pic_local2"];
}
if(isset($_FILES['pic_local3']) && $_FILES['pic_local3']){
    $picArr = $_FILES["pic_local3"];
}
if(isset($_FILES['pic_local4']) && $_FILES['pic_local4']){
    $picArr = $_FILES["pic_local4"];
}

    //条件判断
    if($picArr['error'] != 0){
        die("upload_error");
    }
    if(!in_array($picArr['type'],$uptypes)){
        die("type_error");
    }
    if($picArr['size'] > $max_file_size){
        die("size_error");
    }
    $pic_name = substr(md5(time()), 0, 20);
    $info = pathinfo($picArr['name']);
    $ext = ".".$info['extension'];
    $filename = $pic_name.$ext;
    $flag = move_uploaded_file($picArr['tmp_name'], $destination_folder.$filename);
    if($flag){
        echo json_encode($filename);
    }else{
        echo "upload_error";
    }













//img_create_small("./files/1.png",100,100,"./files/1-as.png");