<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function add($id=0){
        $data = array();
        if($id){
            $data = D('admin')->where("id=$id")->select();
            dump($data);
        }

        $this -> assign("data",$data);
        $this -> display();
    }

    public function checkUsername(){
        die("0");
        $username =$_REQUEST['username'];
        $data = D('admin')->where("username=$username")->select();
        if($data){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function save(){
        $_REQUEST['reg_time']=time();
        $lastid = D('admin')->add($_REQUEST);
        if($lastid){
            $this->success("添加成功","add",5);
        }else{
            $this->error("添加失败","add",5);
        }
    }

    public function alist(){
        $data = array();
       // $alldata = D('admin')->select();
       // if($alldata){$data = $alldata;}
        $this->assign("data",$data);
        $this->display();

    }

}