<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends MyController {
    public $nm = '';
    public function __construct(){
        parent::__construct();
        $this->nm=D('news');
    }

    public function addEdit($id){
        $data = array();
        if($id){
            $data = $this->nm->where("id=$id")->select();
            $data = $data[0];
        }
        $this -> assign("data",$data);
        $this -> display();
    }

    public function picUpload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5242880 ;// 设置附件上传大小 5m
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
        $upload->rootPath = "./Public/Uploads/"; // 设置附件上传根目录
        $upload->saveName =  substr(md5(time()), 0, 20); //文件命名
        $upload->autoSub = true; //允许子目录
        $upload->subName = 'tmp'; //子目录名称（临时存放）
        // 上传单个文件
        $info = $upload->uploadOne($_FILES['pic_news']);
        if(!$info) {// 上传错误提示错误信息
            echo json_encode($upload->getError());
        }else{// 上传成功 获取上传文件信息
            echo json_encode($info['savename']);
        }
    }

    public function nlist(){
        //查询条件
        if(isset($_REQUEST)){
            if($_REQUEST['title']){
                //模糊查询标题
                $map['news.title']  = array('like',"%".urldecode($_REQUEST['title'])."%");
            }
            if($_REQUEST['source']){
                //模糊查询来源
                $map['news.source']  = array('like',"%".urldecode($_REQUEST['source'])."%");
            }
            //时间段查询
            if($_REQUEST['btime'] && $_REQUEST['etime'] && $_REQUEST['btime']!=$_REQUEST['etime']){ //时间不等
                $btime = strtotime($_REQUEST['btime']);
                $etime = strtotime($_REQUEST['etime'])+86400;
                $map['news.pubtime'] = array(array('egt',$btime),array('elt',$etime),"and");
            }
            if($_REQUEST['btime'] && $_REQUEST['btime']==$_REQUEST['etime']){ //时间相等为当天的数据
                $btime = strtotime($_REQUEST['btime']);
                $etime = $btime+86400;
                $map['news.pubtime'] = array(array('egt',$btime),array('elt',$etime),"and");
            }
            if($_REQUEST['btime'] && !$_REQUEST['etime']){ //有开始无结束
                $btime = strtotime($_REQUEST['btime']);
                $map['news.pubtime'] = array("egt",$btime);
            }
            if(!$_REQUEST['btime'] && $_REQUEST['etime']){ //无开始有结束
                $etime = strtotime($_REQUEST['etime'])+86400;
                $map['news.pubtime'] = array("elt",$etime);
            }

        }

        $count = $this->nm->where($map)->count();// 查询满足要求的总记录数
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
        $data = $this->nm
            ->join("left join news_comment nc ON nc.pid=news.id ")
            ->field("news.*,count(nc.pid) as comments")
            ->group("news.id")
            ->order("news.id desc")
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
        $num = $this->nm->delete($id);
        if($num){
            echo "ok";
        }else{
            echo "fail";
        }
    }

    public function delCh(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = $this->nm->delete($ids);
        if($affectedRows == $num){
            echo "ok";
        }
        if($affectedRows == "0"){
            echo "fail";
        }
    }
    public function save(){
        $id = $_REQUEST['id'];
        $_REQUEST['pubtime']=time();
        $_REQUEST['operator']=session("admin_uname");

        if($id) {//更新
            //文件操作
            $nimage = $_REQUEST['image'];
            $data = D('news')->where("id=$id")->select();
            $oimage = $data[0]['image'];
            //更新图片
            if($nimage  && $nimage != $oimage){
                $res = copy("./Public/Uploads/tmp/$nimage","./Public/Uploads/newspic/$nimage");
                unlink("./Public/Uploads/newspic/$oimage");
                if(!$res){echo "fail";}
                $_REQUEST['image'] = $nimage;
            }
            //删除图片
            if(!$nimage && $oimage){
                unlink("./Public/Uploads/newspic/$oimage");
                $_REQUEST['image'] = "";
            }

            //数据库操作
            $num = $this->nm->where("id=$id")->save($_REQUEST);
            if ($num) {
                echo "ok";
            } else {
                echo "fail";
            }
        }else{//添加
            //文件操作
            $nimage = $_REQUEST['image'];
            //添加图片
            if($nimage){
                $res = copy("./Public/Uploads/tmp/$nimage","./Public/Uploads/newspic/$nimage");
                if(!$res){echo "fail";}
                $_REQUEST['image'] = $nimage;
            }

            //数据库操作
            $num = $this->nm->add($_REQUEST);
            if ($num) {
                echo "ok";
            } else {
                echo "fail";
            }
        }
    }


}