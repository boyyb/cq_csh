<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends MyController {
    public function __construct(){
        parent::__construct();
        $username = session('admin_uname');
        $data = D('admin')->where("username='$username'")->field('level')->select();
        $level = $data[0]['level'];
        if($level){
            die("<script>alert('对不起！你无权访问该模块');</script>");
        }
    }

    public function add(){
        $this -> display();
    }

    public function update(){
        $id = $_REQUEST['id'];
        if($id){
            $data = D('admin')->where("id=$id")->select();
            $data = $data[0];
            $this -> assign("data",$data);
            $this -> display();
        }else{
            $this->error("参数传递错误！没有接收到id");
        }
    }

    public function checkUsername(){
        $username =$_REQUEST['username'];
        $data = D('admin')->where("username='$username'")->select();
        if($data){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function save(){
        $_REQUEST['add_time']=time();
        $_REQUEST['password']=$_REQUEST['pwd'];
        $lastid = D('admin')->add($_REQUEST);
        if($lastid){
            $this->success("添加成功","add",3);
        }else{
            $this->error("添加失败","add",3);
        }
    }

    public function alist(){
        $data = array();
        $alldata = D('admin')->select();
        if($alldata){$data = $alldata;}
        $this->assign("data",$data);
        $this->display();

    }

    public function delete(){
        $id = $_REQUEST['id'];
        $num = D('admin')->delete($id);
        if($num){
            echo "1";
        }else{
            echo "0";
        }

    }

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('admin')->delete($ids);
        if($affectedRows == $num){
            echo "1";
        }
        if($affectedRows == "0"){
            echo "0";
        }

    }

    public function usave(){
        $url = $_SERVER['HTTP_REFERER'];//来源页面-更新
        $url_alist = $_REQUEST['url_alist'];//来源页面-管理员列表
        $id = $_REQUEST['id'];
        $_REQUEST['password']=$_REQUEST['pwd'];
        $lastid = D('admin')->where("id=$id")->save($_REQUEST);
        if($lastid){
            $this->success("更新成功",$url_alist,3);
        }else{
            $this->error("更新失败",$url,3);

        }
    }

    public function loglist(){
        $count = D("admin_login")->join("admin ON admin.id=admin_login.pid ")->count();// 总记录数
        $pageSize = 10;//分页显示条数
        $Page = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
        //设置分页样式
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('last', '末页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $Page->lastSuffix = false;//最后一页不显示为总页数
        foreach($_POST as $key=>$val) {
            $Page->parameter[$key] = urlencode($val); //带上查询参数，并url编码
        }
        $show = $Page->show();// 分页显示输出
        //获取表数据，联表查询
        $data = D("admin_login")->join("admin ON admin.id=admin_login.pid ")
            ->field("admin_login.*,admin.*")
            ->order("admin_login.login_time desc")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this -> assign('page',$show);// 赋值分页输出
        $this -> assign('data',$data);// 赋值数据集
        $this -> assign("sn",$Page->firstRow);//序号
        $this -> display();// 输出模板
    }
}