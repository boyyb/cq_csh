<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this -> display();
    }

    public function welcome(){
        date_default_timezone_set('Asia/Shanghai');
        if(session('username')){
            $username = session('username');
            $data = D('admin')->where("username='$username'")->field("recent_login,login_ip")->select();
            $data = $data[0];
            $data['username'] = $username;
            $this->assign('data',$data);
            $this -> display();
        }

    }
}