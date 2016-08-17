<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this -> display();
    }

    public function login(){
        echo session(verify_code);die;
        $vcode_input = $_REQUEST['vcode'];
        $vcode_session = '';
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        //判断验证码
        if($vcode_input == $vcode_session){
            die("vcode_error");
        }

    }

    //验证码
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->entry();

    }

    public function a(){
        session("test",'111');
       echo session_save_path();
    }
    public function b(){
        echo session('test');
        echo session('verify_code');
        dump($_SESSION);
    }






}