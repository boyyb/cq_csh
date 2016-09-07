<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>忘记密码</title>
    <style>
        input[name]{
            width:180px;
            height:22px;
        }
    </style>
</head>
<body>
<p>方式2：通过手机找回</p>
<hr/>
<form action="" method="post">
    <p><input name="username" placeholder="账户名称"/></p>
    <p><input name="phone" placeholder="手机号码" /></p>
    <p><input type="submit" value="发送校验码"/></p>
</form>
<hr/>
</body>
</html>
<?php
header("content-type:text/html;charset=utf-8");
error_reporting(0);
if(isset($_POST) && $_POST){
    require "../public/class/db.class.php";
    $db = new DB();
    $username = $_REQUEST['username'];
    $phone = $_REQUEST['phone'];
    if($_REQUEST['username'] && $_REQUEST['phoneil']){
        $data = $db->getOne('user',"*","username='$username'");
        if(!$data){
            die("用户名不存在！");
        }
        $res = $db->getOne("user","*","username='$username' and phone='$phone'");
        if(!$res){
            die("手机号码不正确！");
        }
    }else{
        die("数据输入不完整！");
    }
}

