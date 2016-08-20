<?php
namespace Home\Controller;
use Think\Controller;
class MessageController extends MyController {

    public function mlist(){
        if(isset($_REQUEST)){
            //筛选出不为空的查询条件
            foreach($_REQUEST as $k=>$v){
                if($v==''){
                    unset($_REQUEST[$k]);
                }else{
                    $_REQUEST[$k]=urldecode($v);//解码还原为正常字符
                }
            }
        }
        $map = $_REQUEST;//处理后的查询条件
        $mm = D('message');
        $count = $mm->where($map)->count();// 查询满足要求的总记录数
        $pageSize = 5;//分页显示条数
        $Page = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val); //带上查询参数，并url编码
        }
        $show = $Page->show();// 分页显示输出
        $data = $mm->order("id desc")->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign("search",$map);//赋值查询的参数，以便显示
        $this->assign('page',$show);// 赋值分页输出
        $this -> assign('data',$data);// 赋值数据集
        $this -> display();// 输出模板
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

    public function insert(){
        $mm=D('message');
        for($a=1;$a<500;$a++){
            $type=array("咨询",'投诉','建议','其他');
            $topic="主题".$a;
            $phone="13".rand(100000000,999999999);
            $email="email".$a."@qq.com";
            $content="content".$a;
            $name="游客".$a;
            $arr['type']=$type[rand(0,3)];
            $arr['topic']=$topic;
            $arr['phone']=$phone;
            $arr['email']=$email;
            $arr['content']=$content;
            $arr['name']=$name;

            $mm->add($arr);
        }
    }

}