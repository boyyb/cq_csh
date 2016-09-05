<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends MyController {

    public function addGoods(){
        $this -> display();
    }

    public function addSeller(){
        $this->display();
    }

    public function saveSeller(){
        $shopname = $_REQUEST['shopname'];
        $sm = D("shop_seller");
        $flag = $sm->where("shopname='$shopname'")->select();
        if($flag){
            $this->error("店铺名称已存在！","addSeller","3");
        }

        $res = $sm->add($_REQUEST);
        if($res){
            $this->success("添加成功","slist","3");
        }
    }

    public function checkshopname(){
        $shopname = $_REQUEST['shopname'];
        $flag = D('shop_seller')->where("shopname='$shopname'")->select();
        if($flag){
            echo "exist";
        }
    }

    public function slist(){
        $sm = D("shop_seller");
        //查询条件
        $map = array();
        if(isset($_REQUEST)){
            if($_REQUEST['shopname']){
                //模糊查询标题
                $map['shopname']  = array('like',"%".urldecode($_REQUEST['shopname'])."%");
            }
            if($_REQUEST['sname']){
                //模糊查询来源
                $map['sname']  = array('like',"%".urldecode($_REQUEST['sname'])."%");
            }

        }

        $count = $sm->where($map)->count();// 查询满足要求的总记录数
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
        $data = $sm
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

    public function deleteSeller(){
        $id = $_REQUEST['id'];
        $res = D('shop_seller')->delete($id);
        if($res){
            echo "ok";
        }else{
            echo "fail";
        }
    }

    public function delChSeller(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('shop_seller')->delete($ids);
        if($affectedRows == $num){
            echo "ok";
        }
        if($affectedRows == "0"){
            echo "fail";
        }
    }

    public function updateSeller($id){
        $data = D("shop_seller")->where("id=$id")->select();
        $this -> assign("data",$data[0]);
        $this -> display();
    }

    public function usaveSeller(){
        $id = $_REQUEST['id'];
        $referer = $_REQUEST['referer'];//来源页面地址
        $sm = D("shop_seller");
        $odata = $sm->where("id=$id")->select();
        $odata = $odata[0];
        //判断数据是否变化
        $num = 0;
        foreach($_REQUEST as $k=>$v){
            if(isset($odata[$k])){
                if($v != $odata[$k]){
                    $num++;
                }
            }
        }
        if($num == 0){
            $this->error("数据没发生变化！",$referer,3);//返回来源列表页面
        }

        //入库
        $res = $sm -> save($_REQUEST);
        if($res){
            $this->success("保存成功！",$referer,4);//返回来源列表页面
        }else{
            $this->error("保存失败！");//返回编辑页面
        }

    }
}