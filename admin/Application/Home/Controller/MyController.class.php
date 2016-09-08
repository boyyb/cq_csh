<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
    //验证用户是否登陆，作为父类控制器
    public function __construct(){
        parent::__construct();//必须引入，否则出错
        if(!session('admin_uname') && !cookie('admin_uname')){
            $this->error('请先登录',U('login/index'),3);
        $this->redirect("login/index");
        }

        //统计在线时长，只针对session
        if(session("admin_uname")){
            $sid = session("session_id");
            $logout_time = time()+120; //默认2分钟后停止操作
            D('admin_login')->where("session_id='$sid'")->save(array("logout_time"=>$logout_time));
        }
    }


}