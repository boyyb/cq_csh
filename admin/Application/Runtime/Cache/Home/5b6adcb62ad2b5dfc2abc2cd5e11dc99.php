<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登陆</title>
    <script src="/1_csh/admin/Public/Js/jquery-2.2.4.min.js"></script>
    <style>

        #login_container{
            margin: 80px auto 0;height:400px;width:500px;
            border:1px solid slategrey;border-radius:4px;background:white;
        }
        #title{
            height:35px;
            width:100%;
            font-weight:bold;
            font-size:20px;
            text-align:center;
            background:cornflowerblue;
            color:white;
            line-height:35px;
        }
        #login_body p{
            height:40px;
            width:300px;
            margin:20px auto;
        }

        #login_body p input[placeholder]{
            height:35px;
            width:300px;
            font-size:19px;
            line-height:35px;
            padding-left: 10px;
            border:1px solid grey;
            border-radius:4px;
        }
        #login_body p input[name=vcode]{
            width:140px;
        }

        #login_body p #submit{
            height:44px;
            width:313px;
            display:block;
            text-decoration: none;
            color:white;
            text-align:center;
            font-size:20px;
            background:green;
            font-family:"微软雅黑 Light";
            border-radius:4px;
            line-height:40px;
        }
        .hint{
            border:1px solid red;
            box-shadow:0 0 4px 1px red;
        }
        #error{
            text-align:center;
        }
    </style>
    <script>
        //倒计时跳转功能
        function jump(num){
            if(num=='0'){
                location.href="http://localhost/1_csh/index1.php";
            }else{
                setTimeout(function(){
                    num--;
                    $('#error').css('color','gray').html("("+num+")秒后跳转到主页,"+'<a href="../index1.php">手动跳转</a>');
                    jump(num);
                },1000)
            }
        }

        $(document).ready(function(){
            $('#submit').click(function(){
                var username = $('input[name=username]').val();
                var password = $('input[name=password]').val();
                var vcode = $('input[name=vcode]').val();
                if(!username || !password || !vcode){
                    if(!username){
                        $('input[name=username]').addClass('hint');
                    }
                    if(!password){
                        $('input[name=password]').addClass('hint');
                    }
                    if(!vcode){
                        $('input[name=vcode]').addClass('hint');
                    }
                    $('#error').css('color','red').html("数据不能为空！");
                    return false;
                }
                $('#submit').html("登陆中...");
                $.post(
                        '<?php echo U("login/login");?>',
                        {"username":username,"password":password,"vcode":vcode},
                        function(data){
                            if(data == "vcode_error"){
                                $('#error').css('color','red').html("验证码错误！");
                                $('input[name=vcode]').addClass('hint');
                                $('#submit').html("登&nbsp;陆");
                            }
                            if(data == "user_ne"){
                                $('#error').css('color','red').html("用户名不存在！");
                                $('input[name=username]').addClass('hint');
                                $('#submit').html("登&nbsp;陆");
                            }else if(data == "pwd_error"){
                                $('#error').css('color','red').html("用户密码错误！");
                                $('input[name=password]').addClass('hint');
                                $('#submit').html("登&nbsp;陆");
                            }else if(data == 'ok'){
                                $('#submit').html("登陆成功！");
                                //$('input[name]').prop('disabled',true);

                                jump(5);
                            }
                        }
                );
            });

            $('input[name]').click(function(){
                $(this).removeClass('hint');
            });
        });
    </script>
</head>
<body style="background: #ccc">

<div id="login_container">
    <div id="title">管理员登录</div>
    <div id="login_body">
        <p><input name="username" placeholder="用户名"/></p>
        <p><input type="password" name="password" placeholder="密码"/></p>
        <p>
            <input name="vcode" placeholder="验证码"/>
            <img style="width:120px;height:35px;vertical-align: middle;margin-left:20px;border-radius:3px;cursor:pointer;"
                 title="点击刷新验证码" src=""/>
        </p>
        <p><input type="checkbox" name="autologin" value="1" id="autologin"/><label for="autologin">一周内自动登陆</label></p>
        <p><a id="submit" href="javascript:void(0)">登&nbsp;陆</a></p>
        <p id="error"></p>
    </div>
</div>
</body>
</html>