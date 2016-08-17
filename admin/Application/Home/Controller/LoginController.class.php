<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this -> display();//登录界面
    }
    //登录验证
    public function login(){
        $vcode_input = $_REQUEST['vcode'];
        $vcode_session = session('vcode');
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $autologin = $_REQUEST['autologin'];
        //判断验证码
        if($vcode_input != $vcode_session){
            echo "vcode_error";
            die;
        }
        //判断用户名是否存在
        $am = D('admin');
        $data = $am->where("username='$username'")->select();
        if(!$data){
            die("user_ne");
        }
        $data = $am->where("username='$username' and password='$password'")->select();
        if(!$data){
            die('pwd_error');
        }
        //自动登录处理
        if($autologin == "1"){
            //...
        }
        //更新表数据,记录登录信息
        $_REQUEST['recent_login']=time();
        $_REQUEST['login_ip']=get_client_ip();
        $am->where("username='$username' and password='$password'")->save($_REQUEST);

        //设置session
        session('username',$username);
        echo "ok";

    }

    //验证码
    public function Captcha(){
        import('Think.Captcha.Captcha');//自定义类
        $_vc = new \Think\Captcha();
        $_vc->doimg();//输出验证码
        session('vcode',$_vc->getCode());//验证码保存到SESSION中
    }

    public function c(){
        echo get_client_ip(0,true);
    }



}