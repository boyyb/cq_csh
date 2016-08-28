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
            //管理员登录数据
            $username = session('admin_uname')?session('admin_uname'):cookie('admin_uname');
            $data = D('admin')->where("username='$username'")->field("id")->select();
            $pid = $data[0]['id'];
            $data = D('admin_login')->where("pid=$pid")->order("login_time desc")->limit(2)->select();
            $data = $data[1];
            $data['username'] = $username;
            //会员统计数据
            $udata['total'] = D('user')->count();
            $beginThisweek = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));
            $now = time();
            $udata['week'] = D('user')->where("reg_time>=$beginThisweek and reg_time<$now")->count();
            //未审核留言
            $mdata['unchecked'] = D('message')->where("checked=0")->count();
            $this->assign('udata',$udata);
            $this->assign('mdata',$mdata);
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