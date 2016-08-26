<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends MyController {
    public function index(){
        //根据级别显示管理员信息的菜单，超级管理员可以看到
        $username = session('admin_uname');
        $data = D('admin')->where("username='$username'")->field('level')->select();
        $level = $data[0]['level'];
        $this -> assign('level',$level);

        $this -> display();
    }

    public function welcome(){
        date_default_timezone_set('Asia/Shanghai');
        if(session('admin_uname') || cookie('admin_uname')){
            $username = session('admin_uname')?session('admin_uname'):cookie('admin_uname');
            $data = D('admin')->where("username='$username'")->field("id")->select();
            $pid = $data[0]['id'];
            $data = D('admin_login')->where("pid=$pid")->order("login_time desc")->limit(2)->select();
            $data = $data[1];
            $data['username'] = $username;
            $this->assign('data',$data);
            $this -> display();
        }

    }


    //管理员自行修改密码
    public function changePwd(){
        $username = $_REQUEST['username'];
        $opwd = $_REQUEST['password'];
        $npwd = $_REQUEST['npassword'];
        $am = D('admin');
        $data = $am->where("username='$username' and password='$opwd'")->select();
        if(!$data){
            echo "opwd_error";
            die;
        }
        $num = $am->where("username='$username'")->save(array('password'=>$npwd));
        if($num){
            echo "ok";
        }else{
            echo "fail";
        }
    }
}