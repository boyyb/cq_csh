<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
    //验证用户是否登陆，作为父类控制器
    public function __construct(){
        parent::__construct();//必须引入，否则出错
        if(!session('username')){
            $this->error('请先登录',U('login/index'),3);
        $this->redirect("login/index");
        }

    }

}