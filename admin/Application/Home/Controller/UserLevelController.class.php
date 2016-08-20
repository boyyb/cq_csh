<?php
namespace Home\Controller;
use Think\Controller;
class UserLevelController extends MyController {
    private $ulm = '';//用户等级模型

    public function __construct(){
        parent::__construct();
        $this -> ulm = D('user_level');
    }

    public function save(){
        $id = $_REQUEST['id'];
        if($id){
            $num = $this->ulm->where("id=$id")->save($_REQUEST);
        }else{
            $num = $this->ulm->add($_REQUEST);
        }
        if($num){
           echo "ok";
        }else{
           echo "fail";
        }
    }

    public function ullist(){
        $data = array();
        $alldata = $this->ulm->order("score_from asc")->select();
        if($alldata){$data = $alldata;}
        $this->assign("data",$data);
        $this->display();

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

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('user_level')->delete($ids);
        if($affectedRows == $num){
            echo "1";
        }
        if($affectedRows == "0"){
            echo "0";
        }

    }

    public function getOneUl(){
        $id=$_REQUEST['id'];
        $data=$this->ulm->where("id=$id")->select();
        if($data){
            echo json_encode($data);
        }else{
            echo "0";
        }
    }
}