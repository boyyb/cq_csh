<?php
namespace Home\Controller;
use Think\Controller;
class OtherController extends MyController {

    public function filelist(){
        $fm = D("file_download");
        //查询条件
        $map = array();
        if(isset($_REQUEST)){
            if($_REQUEST['filename']){
                //模糊查询标题
                $map['filename']  = array('like',"%".urldecode($_REQUEST['filename'])."%");
            }

        }

        $count = $fm->where($map)->count();// 查询满足要求的总记录数
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
        $data = $fm
            ->where($map)
            ->order("id desc")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this -> assign("search",$_REQUEST);//查询的参数回传，以便显示
        $this -> assign('page',$show);// 赋值分页输出
        $this -> assign('data',$data);// 赋值数据集
        $this -> assign("sn",$Page->firstRow);//序号

        $this -> display();// 输出模板

    }
    public function save(){
        $id = $_REQUEST['id'];
        if($id){
            $num = $this->ulm->where("id=$id")->save($_REQUEST);
        }else{
            $num = $this->ulm->add($_REQUEST);
        }
        if($num){
            echo "ok";
        }else{
            echo "fail";
        }
    }
    public function delete(){
        $id = $_REQUEST['id'];
        $num = $this->ulm->delete($id);
        if($num){
            echo "1";
        }else{
            echo "0";
        }

    }

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('user_level')->delete($ids);
        if($affectedRows == $num){
            echo "1";
        }
        if($affectedRows == "0"){
            echo "0";
        }

    }

}