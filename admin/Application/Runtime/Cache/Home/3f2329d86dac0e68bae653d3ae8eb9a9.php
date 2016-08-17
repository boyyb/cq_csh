<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>administrators</title>
    <link rel="stylesheet" href="/1_csh/admin/Public/Index_style/css/index.css" type="text/css" media="screen" />
    <script src="/1_csh/admin/Public/Js/jquery-2.2.4.min.js"></script>
    <style>
        body{margin: 6px 0 0 10px;}
        table{margin-top:15px;}
        table input[type=text],input[type=password]{
            height:25px;
            border-radius:4px;
            padding-left:5px;
        }
        .saveAdmin{
            display: block;
            width:60px;
            height:25px;
            border-radius:3px;
            background:green;
            color:white;
            line-height:25px;
            cursor:pointer;
        }
        select option{
            padding-left:5px;
        }
        .hint{
            border:1px solid red;
            box-shadow:0 0 4px 1px red;
        }
    </style>
    <script>
        $(function(){

            $('input[name=pwd]').bind('blur focus keyup','',function(){
                var password = $('input[name=pwd]').val();
                if(password.length<4){
                    $('.pwd_hint').css('color','red').html("密码长度至少4位！");
                    $(this).addClass('hint');
                }else{
                    $('.pwd_hint').html("");
                    $(this).removeClass('hint');
                }
            });

            $('select[name=level]').change(function(){
                if(!$(this).val()){
                    $('.level_hint').css('color','red').html("请选择管理员等级！");
                    return;
                }
                if($(this).val()=='0'){
                    alert("超级管理员权限太大，你确定要设置为超级管理员！");
                }
                $('.level_hint').html("");
            });

            $('input').click(function(){
                $(this).removeClass('hint');
            });

            $('.saveAdmin').click(function(){
                var password = $('input[name=pwd]').val();
                if(password.length<4){
                    $('.pwd_hint').css('color','red').html("密码长度至少4位！");
                    $('input[name=pwd]').addClass('hint');
                    return;
                }else{
                    $('.pwd_hint').html("");
                    $('input[name=pwd]').removeClass('hint');
                }
                if($('.level_hint').html()){
                    alert("请选择管理员级别！");
                    return;
                }

                $('form').submit();
            });
        });
    </script>
</head>
<body>
<div class="route_bg">
    <a href="javascript:void(0)">管理员信息</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="javascript:void(0)">修改管理员</a>
</div>
<form action="<?php echo U('admin/usave');?>" method="post">
    <table width="80%" border="0">
        <tr height="40">
            <td width="80" align="right">用户名:</td>
            <td width="200">
                <input type="text" name="username" value="<?php echo ($data["username"]); ?>" style="width:180px;" disabled>
                <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
            </td>
            <td>
                <span class="username_hint"></span>
            </td>
        </tr>
        <tr height="40">
            <td align="right">密码：</td>
            <td>
                <input type="password" name="pwd" value="<?php echo ($data["password"]); ?>" style="width:180px;">
            </td>
            <td>
                <span class="pwd_hint"></span>
            </td>
        </tr>
        <tr height="40">
            <td align="right">管理等级：</td>
            <td>
                <select name="level" style="width:150px;height:25px;border-radius:3px;padding-left:5px;">
                    <option value="">请选择</option>
                    <option value="0" <?php if($data['level'] == '0'): ?>selected="selected"<?php endif; ?>>超级管理员</option>
                    <option value="1" <?php if($data['level'] == '1'): ?>selected="selected"<?php endif; ?>>普通管理员</option>
                </select>
            </td>
            <td>
                <span class="level_hint"></span>
            </td>
        </tr>
        <tr height="40">
            <td align="right">是否激活：</td>
            <td align="left">
                <input type="radio" name="state" value="1"  <?php if($data['state'] == 1): ?>checked="checked"<?php endif; ?> id="s1"/><label for="s1">是</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" name="state" value="0"  <?php if($data['state'] == 0): ?>checked="checked"<?php endif; ?> id="s2"/><label for="s2">否</label>

            </td>
            <td></td>
        </tr>
        <tr height="60">
            <td align="right">备注：</td>
            <td>
                <textarea style="width:220px;height:80px;border-radius:3px;resize:none;padding:5px;"  name="note" placeholder="备注信息"><?php echo ($data["note"]); ?></textarea>
            </td>
            <td></td>
        </tr>
        <tr height="40">
            <td align="center" colspan="2">
                <a class="saveAdmin">保存</a>
            </td>
            <td></td>
        </tr>
    </table>
</form>

</body>
</html>