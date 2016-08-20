<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends MyController {
    public $um = '';
    public function __construct(){
        parent::__construct();
        $this->um=D('user');
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

    public function checkUsername(){
        $username =$_REQUEST['username'];
        $data = D('admin')->where("username='$username'")->select();
        if($data){
            echo "1";
        }else{
            echo "0";
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

    public function ulist(){
        die('开发中。。。');
        $data = array();
        $alldata = D('admin')->select();
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