
<!DOCTYPE html>
<html lang="en">
<head>
    <title>其他</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="../public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="file/main.css" type="text/css" rel="stylesheet"/>
    <link href="../public/css/dropmenu.css" rel="stylesheet" type="text/css"/>
    <script src="../public/js/jquery.min.js" type="text/javascript"></script>
    <script src="../public/js/comm.js" type="text/javascript"></script>
    <script type="text/javascript">var submenu_style = 1;</script>
    <script src="../public/js/jquery-1.8.3.min.js"></script>
    <script src="file/global.js"></script>
    <style>
        #other{
            width:1000px;
            min-height:650px;
            border:1px solid #ffffee;
            border-radius:4px;
            margin:10px auto;
            padding:5px;
            background: white;
        }
        #other .left{
            float:left;
            width:90px;
            height:80px;
            //background: darkgray;
            border-radius:4px;
        }
        .left a{
            display: block;
            height:25px;
            text-align: center;
            line-height:25px;
            color:white;
            background:slategrey;
            font-size:15px;
            font-weight:bold;
            text-decoration: none;
            border-radius:4px;
            margin-top:5px;
        }
        .left a:hover{
            background:green;
        }
        .right{
            float:right;
            width:850px;
            min-height:600px;
            border:1px solid #eeeeff;
            border-radius:4px;
            margin-top:5px;
            padding:5px;
        }
        .download_box{
            text-align: left;
        }
        .download_box a{
            font-size:15px;
            color:blue;
            text-decoration: none;
        }
        .download_box a:hover{
            text-decoration: underline;
            color:orangered;
        }
        /**************自由留言样式*****************/
        .demo{width:600px; margin:30px auto; color:#51555c}
        .demo h3{height:32px; line-height:32px; font-size:18px}
        .demo h3 span{float:right; font-size:32px; font-family:Georgia,serif; color:#ccc; overflow:hidden}
        .input{width:594px; height:58px; margin:5px 0 10px 0; padding:4px 2px; border:1px solid #aaa; font-size:12px; line-height:18px; overflow:hidden}
        .sub_btn{float:right; width:94px; height:28px;}
        .clear{clear:both}
        .saylist{margin:8px auto; padding:4px 0; border-bottom:1px dotted #d3d3d3}
        .saylist img{float:left; width:50px; margin:4px}
        .saytxt{float:right; width:530px; overflow:hidden}
        .saytxt p{line-height:18px}
        .saytxt p strong{margin-right:6px}
        .date{color:#999}
        .inact,.inact:hover{background:#f5f5f5; border:1px solid #eee; color:#aaa; cursor:auto;}
        #msg{color:#f30}
        :root #header + #content > #left > #rlblock_left {display:none !important;}
    </style>
    <script>
        $(function(){
            $('.left a').click(function(){
                var classname = $(this).attr('class');
                //颜色样式
                $(this).css("background","green").siblings().css("background","slategrey");
                $('.right .'+classname+'_box').show().siblings().hide();
            });


        });
    </script>
</head>
<body>
<!--引入公共头部-->
<?php include "../public/common/header.php";?>
<div id="other">
    <div class="left">
        <a class="download" href="javascript:void(0)">文档下载</a>
        <a class="freetalk" href="javascript:void(0)">自由发言</a>
        <a class="lottery" href="javascript:void(0)">手机抽奖</a>
    </div>
    <div class="right">
        <div class="download_box" style="display:block;">
            <p>
                <a href="download.php?filename=111.jpg&dl=1" >下载图片</a>
                <a href="download.php?filename=11.jpg&see=1" target="_blank" >查看图片</a>
            <p>
            <p>
                <a href="download.php?filename=11.txt&dl=1">下载文件</a>
                <a href="download.php?filename=11.txt&see=1" target="_blank">查看文件</a>
            </p>
            <p>
                <a href="download.php?filename=11.rar&dl=1">下载压缩文件</a>
                <a href="download.php?filename=11.rar&see=1" target="_blank">查看压缩文件</a>
            </p>
            <p>
                <a href="download.php?filename=11.xlsx&dl=1">下载excel文件</a>
                <a href="download.php?filename=11.xlsx&see=1" target="_blank">查看excel文件</a>
            </p>
            <p>
                <a href="download.php?filename=360.exe&dl=1">下载exe</a>
            </p>
        </div>
        <div class="freetalk_box" style="display:none;">
            <div class="demo">
                <form id="myform" action="submit.php" method="post">
                    <h3><span style="color: rgb(204, 204, 204);" class="counter">140</span>说说你正在做什么...</h3>
                    <input type="hidden" id="ip" name="ip" value="<?php /*echo $ip;*/?>">
                    <input type="hidden" id="location" name="location" value="<?php /*echo $location;*/?>">
                    <textarea name="saytxt" id="saytxt" class="input" tabindex="1" rows="2" cols="40"></textarea>
                    <p>
                        <input src="file/btn.gif" class="sub_btn" alt="发布" type="image">
                        <span id="msg"></span>
                    </p>
                </form>
                <div class="clear"></div>
                <div class="clear"></div>
                <div id="saywrap">
                    <?php /*echo $sayList;*/?>
                </div>
        </div>
        <div class="lottery_box" style="display:none;">

        </div>
    </div>
    <div style="clear:both;"></div>

</div>

<!------------------------底部开始----------------------------->
<?php include "../public/common/footer.php";?>
<!------------------------底部结束----------------------------->

</body>
</html>


