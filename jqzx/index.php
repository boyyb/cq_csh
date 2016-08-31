<?php
header("content-type:text/html;charset=utf-8");
include "../public/class/db.class.php";
$db = new DB();
$newsdata = $db->getAll('news',"*",'',"id desc");
$src= str_replace("jqzx","admin",dirname($_SERVER['SCRIPT_NAME']));
$src= str_replace("\\","/",$src)."/Public/Uploads/newspic/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>景区资讯</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="../public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="../public/css/dropmenu.css" rel="stylesheet" type="text/css"/>
    <script src="../public/js/jquery.min.js" type="text/javascript"></script>
    <script src="../public/js/comm.js" type="text/javascript"></script>
    <script type="text/javascript">var submenu_style = 1;</script>
</head>
<body>
<!--引入公共头部-->
<?php include "../public/common/header.php";?>

<div id="jqzx_container">
    <div id="jqzx_left">
        <div>长寿湖景区资讯&nbsp;&nbsp;></div>
    </div>
    <div id="jqzx_right">
        <?php foreach($newsdata as $k=>$v){ if($v['image']){$pic_name=$v['image'];}else{$pic_name="default.jpg";}?>
        <div class="news">
            <div class="title"><?php echo $v['title'];?></div>
            <div class="pic">
                <img width="100%" height="100%" src="<?php echo $src.$pic_name;?>"/>
            </div>
            <div class="content">
                <p><?php echo mb_substr(strip_tags($v['content']),0,300,'utf-8')."....";?></p>
                <a href="detail.php?id=<?php echo $v['id'];?>" class="morezx">详情...</a>
            </div>
            <div class="bottom">
                <span class="pub_time"><?php echo date("Y-m-d H:i",$v['pubtime']);?></span>
                <span class="source">来源：<?php echo $v['source'];?></span>
            </div>
        </div>
        <?php }?>
    </div>

</div>

<!------------------------底部开始----------------------------->
<?php include "../public/common/footer.php";?>
<!------------------------底部结束----------------------------->
</body>
</html>