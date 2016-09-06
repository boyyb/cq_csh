<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends MyController {

    public function addSeller(){
        $this->display();
    }

    public function saveSeller(){
        $shopname = $_REQUEST['shopname'];
        $sm = D("shop_seller");
        $flag = $sm->where("shopname='$shopname'")->select();
        if($flag){
            $this->error("店铺名称已存在！","addSeller",3);
        }

        $res = $sm->add($_REQUEST);
        if($res){
            $this->success("添加成功","slist","3");
        }else{
            $this->error("添加失败！");
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

    /*商品相关*/
    public function addGoods(){
        $data = D('shop_seller')->select();
        $this -> assign("sdata",$data); //传递商铺信息供产品关联
        $this -> display();
    }

    public function saveGoods(){
        //判断有无图片上传并执行上传操作
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 5242880 ;// 设置附件上传大小 5m
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
            $upload->rootPath = "./Public/Uploads/"; // 设置附件上传根目录
            $upload->saveName =  substr(md5(time()), 0, 20); //文件命名
            $upload->autoSub = true; //允许子目录
            $upload->subName = 'goods'; //子目录名称
            // 上传单个文件
            $info = $upload->uploadOne($_FILES['image']);
            if(!$info) {
                // 上传错误提示信息
                $this->error($upload->getError(),'',3);
            }
            $filename = $info['savename']; //图片名称
            $_REQUEST['showpic'] = $filename;
        }
        //入库
        $gm = D("shop_goods");
        $res = $gm->add($_REQUEST);
        if($res){
            $this -> success("添加成功！","glist",3);
        }else{
            $this->error("添加失败！");
        }

    }

    public function glist(){
        $gm = D("shop_goods");
        //查询条件
        $map = array();
        if(isset($_REQUEST)){
            if($_REQUEST['gname']){
                $map['shop_goods.gname']  = array('like',"%".urldecode($_REQUEST['gname'])."%");
            }
            if($_REQUEST['type']){
                $map['shop_goods.type']  = array('eq',urldecode($_REQUEST['type']));
            }

        }

        $count = $gm->where($map)->count();// 查询满足要求的总记录数
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
        $data = $gm->join("shop_seller ss on ss.id=shop_goods.sellerid")
            ->field("shop_goods.*,ss.shopname")
            ->where($map)
            ->order("shop_goods.id desc")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this -> assign("search",$_REQUEST);//查询的参数回传，以便显示
        $this -> assign('page',$show);// 赋值分页输出
        $this -> assign('data',$data);// 赋值数据集
        $this -> assign("sn",$Page->firstRow);//序号

        $this -> display();// 输出模板
    }

    public function deleteGoods(){
        $id = $_REQUEST['id'];
        $res = D('shop_goods')->delete($id);
        if($res){
            echo "ok";
        }else{
            echo "fail";
        }
    }

    public function delChGoods(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('shop_goods')->delete($ids);
        if($affectedRows == $num){
            echo "ok";
        }
        if($affectedRows == "0"){
            echo "fail";
        }
    }

    public function updateGoods($id){
        $sdata = D('shop_seller')->select();
        $gdata = D('shop_goods')->where("id=$id")->select();

        $this -> assign("sdata",$sdata); //传递商铺信息供产品关联
        $this -> assign("gdata",$gdata[0]);

        $this -> display();
    }

    public function usaveGoods(){
        //删除图片的判断
        if(isset($_REQUEST['delpic']) && $_REQUEST['delpic']){
            $_REQUEST['showpic'] = "";
        }

        //判断有无图片上传并执行上传操作
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 5242880 ;// 设置附件上传大小 5m
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
            $upload->rootPath = "./Public/Uploads/"; // 设置附件上传根目录
            $upload->saveName =  substr(md5(time()), 0, 20); //文件命名
            $upload->autoSub = true; //允许子目录
            $upload->subName = 'goods'; //子目录名称
            // 上传单个文件
            $info = $upload->uploadOne($_FILES['image']);
            if(!$info) {
                // 上传错误提示信息
                $this->error($upload->getError(),'',3);
            }
            $filename = $info['savename']; //图片名称
            $_REQUEST['showpic'] = $filename;
        }

        $id = $_REQUEST['id'];
        $referer = $_REQUEST['referer'];//来源页面地址

        $sm = D("shop_goods");

        $odata = $sm->where("id=$id")->select();
        $odata = $odata[0];

        $oimage = $odata['showpic'];

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
            unlink("./Public/Uploads/goods/$oimage");//删除旧图片
            $this->success("保存成功！",$referer,3);//返回来源列表页面
        }else{
            $this->error("保存失败！",'',3);//返回编辑页面
        }

    }

    //商品展示图（非封面图）
    public function gpiclist($id=0){

        $data = D("shop_image")->where("pid=$id")->select();
        $this->assign("data",$data);
        $this->assign("pid",$id);
        $this->display();

    }

    public function saveGoodsPic(){
        if(!$_REQUEST['pid']){
            $this->error("获取商品ID失败！",'',2);
        }
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 5242880 ;// 设置附件上传大小 5m
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
            $upload->rootPath = "./Public/Uploads/"; // 设置附件上传根目录
            $upload->saveName =  substr(md5(time()), 0, 20); //文件命名
            $upload->autoSub = true; //允许子目录
            $upload->subName = 'goods_more'; //子目录名称
            // 上传单个文件
            $info = $upload->uploadOne($_FILES['image']);
            if(!$info) {
                // 上传错误提示信息
                $this->error($upload->getError(),'',2);
            }
            $filename = $info['savename']; //图片名称
            $_REQUEST['iname'] = $filename;
        }

        //增加到数据库
        $res = D('shop_image')->add($_REQUEST);
        if($res){
            $this->success("添加图片成功！",'',2);
        }else{
            $this->error("添加图片失败！",'',2);
        }
    }

    public function deleteGoodsPic(){
        $id = $_REQUEST['id'];
        $filename = D('shop_image')->where("id=$id")->select();
        $filename = $filename[0]['iname'];

        unlink("./Public/Uploads/goods_more/$filename");//删除图片文件

        $flag = D("shop_image")->delete($id);//删除数据库数据
        if($flag){
           echo "ok";
        }else{
            echo "fail";
        }

    }

    /****订单列表****/
    public function olist(){
        $om = D("shop_order");
        //查询条件
        $map = array();
        if(isset($_REQUEST)){
            //模糊查询商品名
            if($_REQUEST['gname']){
                $map['shop_order.gname']  = array('like',"%".urldecode($_REQUEST['gname'])."%");
            }
            //状态查询
            if($_REQUEST['state']){
                $map['shop_order.state']  = array('eq',urldecode($_REQUEST['state']));
            }
            //时间段查询
            if($_REQUEST['btime'] && $_REQUEST['etime'] && $_REQUEST['btime']!=$_REQUEST['etime']){ //时间不等
                $btime = strtotime($_REQUEST['btime']);
                $etime = strtotime($_REQUEST['etime'])+86400;
                $map['time'] = array(array('egt',$btime),array('elt',$etime),"and");
            }
            if($_REQUEST['btime'] && $_REQUEST['btime']==$_REQUEST['etime']){ //时间相等为当天的数据
                $btime = strtotime($_REQUEST['btime']);
                $etime = $btime+86400;
                $map['time'] = array(array('egt',$btime),array('elt',$etime),"and");
            }
            if($_REQUEST['btime'] && !$_REQUEST['etime']){ //有开始无结束
                $btime = strtotime($_REQUEST['btime']);
                $map['time'] = array("egt",$btime);
            }
            if(!$_REQUEST['btime'] && $_REQUEST['etime']){ //无开始有结束
                $etime = strtotime($_REQUEST['etime'])+86400;
                $map['time'] = array("elt",$etime);
            }
        }

        $count = $om->where($map)->count();// 查询满足要求的总记录数
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
        $data = $om
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

    public function deleteOrder(){
        $id = $_REQUEST['id'];
        $res = D("shop_order")->delete($id);
        if($res){
            echo "ok";
        }else{
            echo "fail";
        }
    }

    public function delChOrder(){
        $ids = $_REQUEST['ids'];
        $num = $_REQUEST['num'];
        $affectedRows = D('shop_order')->delete($ids);
        if($affectedRows == $num){
            echo "ok";
        }
        if($affectedRows == "0"){
            echo "fail";
        }
    }
}