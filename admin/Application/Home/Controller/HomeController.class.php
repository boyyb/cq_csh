<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends MyController {

    public function sliderShow(){
        $data = array();
        $alldata = D('slider_pic')->order("pic_order asc")->select();
        if($alldata){
            $data = $alldata;
            //处理图片路径
            foreach($data as $k=>$v){
                if($v['pic_name']){
                    $data[$k]['pic_name']=__ROOT__.'/Public'."/Uploads/slider/".$v['pic_name'];
                }else{
                    $data[$k]['pic_name']=$v['pic_url'];
                }
            }
        }
        $this->assign("data",$data);
        $this->display();

    }

    public function sliderUpload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5242880 ;// 设置附件上传大小 5m
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
        $upload->rootPath = "./Public/Uploads/"; // 设置附件上传根目录
        $upload->saveName =  substr(md5(time()), 0, 20); //文件命名
        $upload->autoSub = true; //允许子目录
        $upload->subName = 'tmp'; //子目录名称（临时存放）
        // 上传单个文件
        switch(1){
            case isset($_FILES['pic_local1']):$pic = 'pic_local1';break;
            case isset($_FILES['pic_local2']):$pic = 'pic_local2';break;
            case isset($_FILES['pic_local3']):$pic = 'pic_local3';break;
            case isset($_FILES['pic_local4']):$pic = 'pic_local4';break;
        }
        $info = $upload->uploadOne($_FILES[$pic]);
        if(!$info) {// 上传错误提示错误信息
            echo json_encode($upload->getError());
        }else{// 上传成功 获取上传文件信息
            echo json_encode($info['savename']);
        }
    }
    public function delete(){
        $id = $_REQUEST['id'];
        $num = $this->ulm->delete($id);
        if($num){
            echo "1";
        }else{
            echo "0";
        }

    }

    public function sliderSave(){
        $pic_order = $_REQUEST['order'];
        $source = $_REQUEST['source'];
        $npic_name = $_REQUEST['pic_name'];
        $prompt = $_REQUEST['prompt'];
        $sm = D('slider_pic');
        $data = $sm->where("pic_order=$pic_order")->select();
        $data = $data[0];
        //选择本地上传：删除旧文件，转移新文件，清空网络url
        if($source=="local"){
            //删除旧文件
            $opic_name = $data['pic_name'];
            unlink("./Public/Uploads/slider/$opic_name");
            //转移新文件
            $res = copy("./Public/Uploads/tmp/$npic_name","./Public/Uploads/slider/$npic_name");
            if(!$res){die("move fail");}
            //入库
            $_REQUEST['pic_url']="";
            $flag = $sm->where("pic_order=$pic_order")->save($_REQUEST);
            if($flag){
                echo "ok";
            }else{
                echo "database save error";
                unlink("./Public/Uploads/slider/$npic_name");
            }
        }else if($source=="network"){
            //删除旧文件
            $opic_name = $data['pic_name'];
            unlink("./Public/Uploads/slider/$opic_name");
            //入库
            $_REQUEST['pic_url']=$npic_name;
            $_REQUEST['pic_name'] = "";
            $flag = $sm->where("pic_order=$pic_order")->save($_REQUEST);
            if($flag){
                echo "ok";
            }else{
                echo "database save error";
            }

        }else{
            $flag = $sm->where("pic_order=$pic_order")->save(array("prompt"=>$prompt));
            if($flag){
                echo "ok";
            }else{
                echo "database save error";
            }
        }

    }
}