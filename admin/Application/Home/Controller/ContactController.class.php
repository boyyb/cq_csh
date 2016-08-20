<?php
namespace Home\Controller;
use Think\Controller;
class ContactController extends MyController {
    private $cm = '';//用户等级模型

    public function __construct(){
        parent::__construct();
        $this -> cm = D('contact');
    }

    public function save(){
        $id=$_REQUEST['id'];
        $_REQUEST['edittime']=time();
        $_REQUEST['editer']=session('admin_uname');
        if($id){
            $num = D('contact')->where("id=$id")->save($_REQUEST);
        }else{
            $num = D('contact')->add($_REQUEST);
        }
        if($num){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function show(){
        $data = array();
        $alldata = $this->cm->select();
        if($alldata){$data = $alldata[0];}
        $this->assign("data",$data);
        $this->display();

    }

}