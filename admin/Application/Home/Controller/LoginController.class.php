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
        //判断用户是否激活
        if($data[0]['state'] == '0'){
            die("user_lock");
        }
        //自动登录处理
        if($autologin == "1"){
            cookie("admin_uname",$username,86400*7);
        }
        //更新记录表数据,记录登录信息
        $alm = D('admin_login');
        $session_id = time().rand(1000,9999);
        $_REQUEST['session_id'] = $session_id;
        $_REQUEST['pid'] = $data[0]['id'];
        $_REQUEST['login_time']=time();
        $_REQUEST['login_ip']=get_client_ip();
        $alm->add($_REQUEST);

        //设置session
        session('admin_uname',$username);
        session("session_id",$session_id);
        echo "ok";

    }

    //验证码
    public function Captcha(){
        import('Think.Captcha.Captcha');//自定义类
        $_vc = new \Think\Captcha();
        $_vc->doimg();//输出验证码，先运行doimg,才能获取验证码
        session('vcode',$_vc->getCode());//验证码保存到SESSION中
        //echo $_vc->getCode();
    }

    public function logout(){
        session('admin_uname',null);
        cookie('admin_uname',null);
        //记录登出时间
        $sid = session("session_id");
        D('admin_login')->where("session_id='$sid'")->save(array("logout_time"=>time()));

        $this -> success("注销成功！",'index',2);
    }


}