<?php
namespace Home\Controller;
use Think\Controller;
class UserLevelController extends MyController {
    private $ulm = '';//用户等级模型

    public function __construct(){
        parent::__construct();
        $this -> ulm = D('user_level');
    }

    public function update(){
        $id = $_REQUEST['id'];
        if($id){
            $data = D('admin')->where("id=$id")->select();
            $data = $data[0];
            $this -> assign("data",$data);
            $this -> display();
        }else{
            $this->error("参数传递错误！没有接收到id");
        }
    }


    public function save(){
        $_REQUEST['add_time']=time();
        $_REQUEST['password']=$_REQUEST['pwd'];
        $lastid = D('admin')->add($_REQUEST);
        if($lastid){
            $this->success("添加成功","add",3);
        }else{
            $this->error("添加失败","add",3);
        }
    }

    public function ullist(){
        $data = array();
        $alldata = $this->ulm->order("priority desc")->select();
        if($alldata){$data = $alldata;}
        $this->assign("data",$data);
        $this->display();

    }

    public function delete(){
        $id = $_REQUEST['id'];
        $num = D('admin')->delete($id);
        if($num){
            echo "1";
        }else{
            echo "0";
        }

    }

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('user')->delete($ids);
        if($affectedRows == $num){
            echo "1";
        }
        if($affectedRows == "0"){
            echo "0";
        }

    }

    public function usave(){
        $url = $_SERVER['HTTP_REFERER'];//来源页面-更新
        $url_alist = $_REQUEST['url_alist'];//来源页面-管理员列表
        $id = $_REQUEST['id'];
        $_REQUEST['password']=$_REQUEST['pwd'];
        $lastid = D('admin')->where("id=$id")->save($_REQUEST);
        if($lastid){
            $this->success("更新成功",$url_alist,3);
        }else{
            $this->error("更新失败",$url,3);

        }
    }
}