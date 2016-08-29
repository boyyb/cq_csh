<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends MyController {
    public $um = '';
    public function __construct(){
        parent::__construct();
        $this->um=D('user');
    }

    public function ulist(){
        //筛选出不为空的查询条件
        if(isset($_REQUEST)){
            foreach($_REQUEST as $k=>$v){
                if($v=='' || $k=="p"){ //查询条件排除p
                    unset($_REQUEST[$k]);
                }else{
                    //模糊查询姓名
                    if($k=="username"){
                        $map[$k]  = array('like',"%".$v."%");
                    }else{
                        $map[$k]=array('eq',urldecode($v));//解码还原为正常字符(汉字)
                    }
                }
            }
        }

        $count = $this->um->where($map)->join("user_level ul ON ul.id=user.level_id ")->count();// 查询满足要求的总记录数
        $pageSize = 5;//分页显示条数
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
        $data = $this->um
            ->join("user_level ul ON ul.id=user.level_id ")
            ->field("user.*,ul.level_name")
            ->order("user.id desc")
            ->where($map)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this -> assign("search",$_REQUEST);//查询的参数回传，以便显示
        $this -> assign('page',$show);// 赋值分页输出
        $this -> assign('data',$data);// 赋值数据集
        $this -> assign("sn",$Page->firstRow);//序号
        //传用户等级数据到模版
        $level_name_arr = D('user_level')->order("score_from asc")->select();
        $this -> assign('levelArr',$level_name_arr);

        $this -> display();// 输出模板
    }

    public function delete(){
        $id = $_REQUEST['id'];
        $num = $this->um->delete($id);
        if($num){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = $this->um->delete($ids);
        if($affectedRows == $num){
            echo "1";
        }
        if($affectedRows == "0"){
            echo "0";
        }
    }
    public function save(){
        $id = $_REQUEST['id'];
        if($id) {
            //更新
            $num = $this->um->where("id=$id")->save($_REQUEST);
            if ($num) {
                echo "ok";
            } else {
                echo "fail";
            }
        }else{
            echo "fail";
        }
    }

    public function lock($id,$state){
        $url = $_SERVER['HTTP_REFERER'];
        $arr = array('state'=>$state);
        $this->um->where("id=$id")->save($arr);
        redirect($url);


    }

   public function detail($id){
        if($id){
            $url = $_SERVER['HTTP_REFERER'];
            $data = $this->um
                ->join("left join user_level ul ON ul.id=user.level_id ") //左连接
                ->join("left join user_pic up ON up.pid=user.id") //左连接
                ->field("user.*,ul.level_name,up.pic_name")
                ->where("user.id=$id")
                ->select();
            $data[0]['url'] = $url;
            $this -> assign('data',$data[0]);
            //传递根目录，以便显示头像
            $root = dirname(__ROOT__);
            $this -> assign('root',$root);
            $this -> display();
        }else{
            $this->error("用户ID获取失败");
        }
   }

    public function loglist(){
        //筛选出不为空的查询条件
        if(isset($_REQUEST)){
            foreach($_REQUEST as $k=>$v){
                if($v=='' || $k=="p"){ //查询条件排除p
                    unset($_REQUEST[$k]);
                }else{
                    //模糊查询姓名
                    if($k=="username"){
                        $map[$k]  = array('like',"%".$v."%");
                    }else{
                        //登录时间查询
                        $v = urldecode($v);//解码还原为正常字符(针对汉字)
                        $btime = strtotime($v);
                        $etime = $btime+86400;
                        //$map[$k] = array('egt',$btime);
                        //$map[$k] = array('lt',$etime);
                        $map[$k] = array(array('egt',$btime),array('lt',$etime),"and");
                    }
                }
            }
        }

        $count = $this->um->where($map)->join("user_login ul ON ul.pid=user.id ")->count();// 查询满足要求的总记录数
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
        $data = $this->um
            ->join("user_login ul ON ul.pid=user.id ")
            ->field("user.username,ul.*")
            ->order("ul.login_time desc")
            ->where($map)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this -> assign("search",$_REQUEST);//查询的参数回传，以便显示
        $this -> assign('page',$show);// 赋值分页输出
        $this -> assign('data',$data);// 赋值数据集
        $this -> assign("sn",$Page->firstRow);//序号

        $this -> display();// 输出模板

    }

}