<?php
session_start();
date_default_timezone_set("PRC");
require_once '../public/class/db.class.php';
$db = new DB();
$username = $_SESSION['username'];
$arr = $db->getOne('user',"*","username='$username'");
$id = $arr['id'];
$data = $db -> getOne('user_pic',"pic_name","pid=$id");
if($data){
    $src="../public/upload/user_pic/".$data['pic_name'];
}else{
    $src="../public/upload/user_pic/default.png";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户个人资料</title>
    <script type="text/javascript" src="../public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="../public/js/jquery.form.js"></script>
    <style>
        #base,#cpwd{
            width:100%;
            background:green;
            color:white;
            text-align:center;
            font-size:16px;
            font-weight:bold;
            height:30px;
            line-height:30px;
            border-radius:4px;
        }

        #isubmit,#back{
            float:left;
            height:25px;
            width:60px;
            text-decoration: none;
            font-size:16px;
            color:whitesmoke;
            display: block;
            background: green;
            border-radius:4px;
            line-height:25px;
        }
        #isubmit{
            margin-left:250px;
            margin-right:60px;

        }
        #psubmit{
            height:25px;
            width:90px;
            text-decoration: none;
            font-size:16px;
            color:whitesmoke;
            display: block;
            background: green;
            border-radius:4px;
            line-height:25px;
        }
        #psubmit:hover,#isubmit:hover,#back:hover{
            background: darkred;
        }
        /*****************************************弹窗样式**********************************/
        #win_add{
            display : none;
            position : absolute;
            width : 400px;
            height: 220px;
            top : 150px;
            left: -200px;;
            margin-left:50%;
            z-index: 1051;
            border-radius:4px;
            border:1px gray solid;
            background: white;
        }
        #title_add{
            height:30px;
            background-color : #0066bb;
            color : ghostwhite;
            padding-left:4px;
            font-size:16px;
            line-height:30px;
        }
        #close_add{
            position:absolute;
            top:0px;
            right:10px;
            cursor: pointer;
        }
        #close_add:hover{
            color:orangered;
        }
        #content_add{
            padding-top : 10px;
        }
        #button_add{
            position:absolute;
            left:-111px;
            margin-left:50%;
            bottom:10px;
            height:30px;
            width:222px;
            color : ghostwhite;
            font-size:16px;
            line-height:30px;
        }
        .save_add,.closewin_add{
            display: block;
            height:25px;
            width:70px;
            background: forestgreen;
            color:whitesmoke;
            -webkit-border-radius:3px;
            -moz-border-radius:3px;
            border-radius:3px;
            text-align: center;
            line-height:25px;
            text-decoration: none;
            float:left;
        }
        .save_add{
            margin-right:80px;
        }
        .mask{
            background-color: #333333;
            z-index: 1050;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            filter: Alpha(Opacity=30);
            -moz-opacity: 0.4;
            opacity: 0.4;
        }

    </style>
    <script>
        $(function () {
            var files = $(".files");
            $("#fileupload").wrap("<form id='myupload' action='action_pic.php' method='post' enctype='multipart/form-data'></form>");
            $("#fileupload").change(function(){
                $("#myupload").ajaxSubmit({
                    dataType:  'json',
                    success: function(data) {
                        $("#pic").attr("src","http://localhost/1_csh/public/upload/tmp/"+data);
                        $('input[name=src]').val(data);
                    },
                    error:function(xhr){
                        alert("上传失败："+xhr.responseText);
                    }
                });
            });

            //打开弹窗-会员等级
            $('#changePic').click(function(){
                $('.mask').css('display','block');
                $('#win_add').fadeIn('normal');


            });
            //关闭弹窗
            $('.closewin_add,#close_add').click(function(){
                $('#win_add').hide();
                $('.mask').css('display','none');

                window.location.reload();
            });
            //保存
            $('.save_add').click(function(){
                var id = $('input[name=id][type=hidden]').val();
                var src = $('input[name=src]').val();
                var file =  $('#fileupload').val();
                if(!file){
                    alert("没有选择文件！");
                    return;
                }
                if(!src){
                    if(num == 0){
                        $('.prompt_info').css('color','red').html("文件名获取失败！");
                        return;
                    }
                }
                $('.prompt_info').css('color','blue').html("头像保存中...");
                $.post(
                    "action_pic.php",
                    {"pic_name":src,"id":id,"save":1},
                    function(data){
                        if(data=="ok"){
                            alert("保存成功！");
                            window.location.reload();
                        }else{
                            $('.prompt_info').css('color','red').html("保存失败！");
                            return;
                        }
                    }
                );
            });
        });

    </script>
</head>
<body style="background:#f2f9f2;">
    <table  width="700px" align="center" style="background: white;margin-top:50px;">
        <tr height="30">
            <td colspan="4"><div id="base">用户信息</div></td>
        </tr>
        <tr height="10">
            <td rowspan="5" width="70" align="right" valign="top">
                <img id="changePic" title="点击更改头像"
                     style="cursor:pointer;height:60px;width:60px;margin-top:20px;border-radius:4px;border:1px solid gray"
                     src="<?php echo $src;?>"/>
            </td>
            <td colspan="3"></td>
        </tr>
        <tr height="35">
            <td width="50" align="right">用户名：</td>
            <td width="140">
                <input type="text" disabled value="<?php echo $arr['username'];?>"/>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="src" value="">
            </td>
            <td></td>
        </tr>
        <tr height="35">
            <td align="right">性别：</td>
            <td>
                <input type="text" disabled value="<?php echo $arr['sex'];?>"/>
            </td>
            <td></td>
        </tr>
        <tr height="35">
            <td align="right">电话号码：</td>
            <td>
                <input name="phone" type="text" value="<?php echo $arr['phone'];?>"/>
            </td>
            <td></td>
        </tr>
        <tr height="35">
            <td align="right">邮箱：</td>
            <td>
                <input name="email" type="text" value="<?php echo $arr['email'];?>"/>
            </td>
            <td></td>
        </tr>
        <tr height="35">
            <td colspan="4" align="center">
                <a id="isubmit" href="javascript:void(0)">更新</a>
                <a id="back" href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a>
            </td>
        </tr>
        <tr height="50"><td colspan="3">
                <span id="hint_update"></span>
            </td></tr>
        <tr height="30">
            <td colspan="4"><div id="cpwd">密码修改</div></td>
        </tr>
        <tr height="35">
            <td align="right" width="150">原始密码：</td>
            <td>
                <input type="password" name="opassword"/>
            </td>
            <td></td>
        </tr>
        <tr height="35">
            <td align="right">新密码：</td>
            <td>
                <input type="password" name="npassword"/>
            </td>
            <td></td>
        </tr>
        <tr height="35">
            <td align="right">确认密码：</td>
            <td>
                <input type="password" name="cpassword"/>
            </td>
            <td align="center"><a id="psubmit" href="javascript:void(0)">修改密码</a></td>
        </tr>
        <tr height="35">
            <td colspan="4" align="center">
               <span class="hint_cp"></span>
            </td>
        </tr>
    </table>

<div id="win_add" style="display:none;">
        <div id="title_add">
            <span>更换用户头像</span>
            <a id="close_add" title="点击关闭">X</a>
        </div>
        <div id="content_add">
            <div style="width:60px;height:60px; margin: 10px auto;">
                <img width="100%" height="100%" src="<?php echo $src;?>" id="pic">
            </div>
            <table width="100%">
                <tr>
                    <td align="right" width="180" style="font-size:14px;">更换头像：</td>
                    <td><a href="javascript:;" class="a-upload"><input id="fileupload" type="file" name="mypic"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><span class="prompt_info"></span></td>
                </tr>
            </table>

        </div>
        <div id="button_add">
            <a class="save_add" href="javascript:void(0)">保存</a>
            <a class="closewin_add" href="javascript:void(0)">关闭</a>
        </div>
    </div>

<div class="mask" style="display:none;"></div>
</body>
</html>