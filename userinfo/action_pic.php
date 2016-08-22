<?php
error_reporting(0);
include "../public/class/db.class.php";
$db=new DB();

if(isset($_POST['save'])){//保存文件名到数据库
    $pid=$_POST['id'];
    $pic_name=$_POST['pic_name'];
    //转移图片文件
    $bool = rename("../public/upload/tmp/".$pic_name,"../public/upload/user_pic/".$pic_name);
    $bool1 = rename("../public/upload/tmp/thumb_".$pic_name,"../public/upload/user_pic/thumb_".$pic_name);
    if(!$bool && !$bool1){
        die("copy_fail");
    }
    $old = $db->getOne('user_pic',"*","pid=$pid");
    $opic_name = $old['pic_name'];
    if($old){
        $db->update('user_pic',array("pic_name"=>$pic_name),"pid=$pid");
        $num = $db->getAffectedRows();
        //删除旧文件
        unlink("../public/upload/user_pic/".$opic_name);
        unlink("../public/upload/user_pic/thumb_".$opic_name);
    }else{
        $db->add('user_pic',array("pid"=>$pid,"pic_name"=>$pic_name));
        $num = $db->getLastId();
    }

    if($num){
        echo "ok";
    }else{
        //保存数据库失败，删除上传的图片
        echo "fail";
        unlink("../public/upload/user_pic/".$pic_name);
        unlink("../public/upload/user_pic/thumb_".$pic_name);
    }
}else{ //执行上传文件操作
    //上传文件条件参数
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
    $destination_folder="../public/upload/tmp/"; //上传文件目录
    $imgpreview=1;	  //是否生成预览图(1为生成,其他为不生成);

//条件判断
    $picArr = $_FILES["mypic"];
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
    $flag = move_uploaded_file($_FILES['mypic']['tmp_name'], $destination_folder.$filename);
    if($flag){echo json_encode($filename);}else{echo "upload_error";}


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
    if($imgpreview==1){
        $root = $_SERVER['DOCUMENT_ROOT'];
        img_create_small($root."/1_csh/public/upload/tmp/".$filename,100,100,$destination_folder."thumb_".$pic_name.$ext);
    }
}