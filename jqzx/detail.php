<?php
header("content-type:text/html;charset=utf-8");
include "../public/class/db.class.php";
$db = new DB();
$id = $_GET['id'];
$data = $db->getOne('news',"*","id=$id");
$ncdata = $db->getAll("news_comment","*","pid=$id","id desc");
$nccount = count($ncdata);
$src= str_replace("jqzx","admin",dirname($_SERVER['SCRIPT_NAME']));
$nsrc= str_replace("\\","/",$src)."/Public/Uploads/newspic/";
$usrc= "../public/upload/user_pic/";
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
    <script src="../public/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <style>
        #jqzx_right .news_detail{
            width:780px;
            min-height:500px;
            border:1px solid lightgrey;
            border-radius:4px;
            background: ghostwhite;
        }
        .news_detail h4{
            margin-top:10px;
        }
        .news_detail h4 span{
            margin-right:10px;
        }
        .news_detail span button,.button{
            height:22px;
            width:60px;
            border:1px solid gray;
            border-radius:4px;
            cursor:pointer;
            background: darkgreen;
            color:white;
        }
        .wenzi{
            width:100%;
            margin-top:10px;
        }
        .wenzi p{
            font-size:15px;
            text-align:left;
            padding: 10px 5px;
        }
        .comment textarea{
            height:80px;
            width:400px;
            resize: none;
            padding:5px;
            margin-top:20px;
            vertical-align:bottom;
        }
        .ctop{
            margin-top:20px;
            height:30px;
            background: slategrey;
            line-height:30px;
            text-align:left;
            padding-left:10px;
            font-weight:bold;
            color:antiquewhite;
        }
        .commentshow{
            font-size:13px;
        }
        .commentshow td{
            padding-left:5px;
        }

    </style>
    <script>
        $(document).ready(function(){
            $('.csave').click(function(){
                var user = $('input[name=user][type=hidden]').val() || "游客";
                var content = $('.comment textarea').val();
                var pid = $('input[name=pid][type=hidden]').val();
                if(!content){
                    $('.cprompt').css('color','red').html("评论内容为空！");
                    return false;
                }
                $('.cprompt').css('color','green').html("数据提交中...");
                $(this).attr("disabled",true);
                $.post(
                    "save.php",
                    {"content":content,"user":user,"pid":pid},
                    function(i){
                        if(i){
                            $('.cprompt').css('color','green').html("提交成功！");
                            $('.ctop').after(i);
                        }else{
                            $('.cprompt').css('color','red').html("提交失败！");
                        }
                        $('.csave').attr("disabled",false);
                    },"html"
                );

            });


        });
    </script>
</head>
<body>
<!--引入公共头部-->
<?php include "../public/common/header.php";?>

<div id="jqzx_container">
    <div id="jqzx_left">
        <div>长寿湖景区资讯&nbsp;&nbsp;></div>
    </div>
    <div id="jqzx_right">
       <div class="news_detail">
           <h1><?php echo $data['title'];?></h1>
           <h4>
               <span>发布时间：<?php echo date("Y-m-d H:i",$data['pubtime']);?></span>&nbsp;&nbsp;
               <span>来源：<?php echo $data['source'];?></span>&nbsp;&nbsp;
               <span>评论数：<?php echo $nccount;?></span>
               <span>
                   <button>顶(999)</button>
                   <button>踩(9999)</button>
               </span>
           </h4>
           <div class="wenzi">
               <?php if($data['image']){?>
               <img src="<?php echo $nsrc.$data['image'];?>" style="width:500px;height:300px;"/>
               <?php }?>
               <?php echo $data['content'];?>
           </div>
           <div class="comment">
               <input type="hidden" name="user" value="<?php echo @$_SESSION['username'];?>"/>
               <input type="hidden" name="pid" value="<?php echo $data['id'];?>"/>
               <textarea placeholder="留言内容"></textarea>
               <button class="csave button" >发布</button><br/>
               <span class="cprompt"></span>
           </div>
           <div class="commentshow">
               <div class="ctop">查看评论</div>
               <?php foreach($ncdata as $k=>$v){?>
               <table width="100%" border="1" style="margin:5px auto;">
                   <tr heigh="25">
                       <td colspan="4" align="left" >
                           <?php echo $v['username'];?> 在 <?php echo date('Y-m-d H:i:s',$v['time']);?>发表&nbsp;&nbsp;ip:<?php echo $v['ip'];?>
                       </td>
                   </tr>
                   <tr>
                       <td width="60" align="left" valign="top">
                           <img style="height:50px;width:50px;margin-top: 8px;" src="<?php echo $usrc.$v['photo'];?>"/>
                       </td>
                       <td align="left" valign="top">
                           <?php echo $v['content'];?>
                       </td>
                   </tr>
               </table>
              <?php }?>
           </div>
       </div>
    </div>

</div>

<!------------------------底部开始----------------------------->
<?php include "../public/common/footer.php";?>
<!------------------------底部结束----------------------------->
</body>
</html>