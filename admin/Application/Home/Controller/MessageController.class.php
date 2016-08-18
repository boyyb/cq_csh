<?php
namespace Home\Controller;
use Think\Controller;
class MessageController extends MyController {

    public function mlist(){
        $mm = D('message');
        $data = $mm->order("time desc")->select();
        if(isset($_REQUEST['search'])){
            //筛选出不为空的查询条件
            foreach($_REQUEST as $k=>$v){
               if($v=='' || $k=='search'){
                   unset($_REQUEST[$k]);
               }
            }
            if($_REQUEST){
                $data = $mm->where($_REQUEST)->order("time desc")->select();
                //返回查询的参数
                $this->assign('search',$_REQUEST);
            }

        }

        $this -> assign('data',$data);
        $this -> display();
    }

    public function add($id = 0){
        if($id){
            $data = D('message')->where("id=$id")->select();
            $data = $data[0];
            $this -> assign("data",$data);
        }
        $this -> display();
    }

    public function delete(){
        $id = $_REQUEST['id'];
        $num = D('message')->delete($id);
        if($num){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('message')->delete($ids);
        if($affectedRows == $num){
            echo "1";
        }
        if($affectedRows == "0"){
            echo "0";
        }
    }
    public function save(){
        $id = $_REQUEST['id'];
        $mm = D('message');
        if($id){
            //更新
            $num = $mm -> where("id=$id")->save($_REQUEST);
            if($num){
                echo "update_ok";
            }else{
                echo "udpate_fail";
            }
        }else{
            //添加
            $_REQUEST['time']=time();
            $num = $mm -> add($_REQUEST);
            if($num){
                echo "add_ok";
            }else{
                echo "add_fail";
            }
        }

    }


    public function check($id,$check){
        $url = $_SERVER['HTTP_REFERER'];
        $arr = array('checked'=>$check);
        D('message')->where("id=$id")->save($arr);
        redirect($url);


    }

}