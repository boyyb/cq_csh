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
        //if(session('username')){
            $username = session('admin_uname');
            $data = D('admin')->where("username='$username'")->field("recent_login,login_ip")->select();
            $data = $data[0];
            $data['username'] = $username;
            $this->assign('data',$data);
            $this -> display();
        //}

    }
}