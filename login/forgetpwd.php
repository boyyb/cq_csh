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
<form action="" method="post">
    <p><input name="username" placeholder="账户名称"/></p>
    <p><input name="email" placeholder="注册邮箱" /></p>
    <p><input type="submit" value="发送校验码"/></p>
</form>
<hr/>
<p>邮件收到校验码后请在下面输入，并重置密码！</p>
<form action="checkcode.php" method="post">
    <p><input name="token" placeholder="输入邮件中的校验码"/></p>
    <p><input name="password" placeholder="新密码" /></p>
    <p><input name="cpassword" placeholder="确认新密码" /></p>
    <p><input type="submit" value="提交"/></p>
</form>
</body>
</html>
<?php
header("content-type:text/html;charset=utf-8");
error_reporting(0);
if(isset($_POST)){
    require '../public/class/PHPMailer/class.smtp.php';
    require '../public/class/PHPMailer/class.phpmailer.php';
    require "../public/class/db.class.php";
    $db = new DB();
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    if($_REQUEST['username'] && $_REQUEST['email']){
        $data = $db->getOne('user',"*","username='$username'");
        if(!$data){
            die("用户名不存在！");
        }
        $res = $db->getOne("user","*","username='$username' and email='$email'");
        if(!$res){
            die("邮箱不正确！");
        }
    }else{
        die("数据输入不完整！");
    }
    $code = time();
    $_SESSION['usercode'] = $code; //存入session中，以便比对
    $_SESSION['username'] = $username;
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->CharSet='UTF-8';
    $mail->SMTPAuth = true;
    $mail->Port = 25;
    $mail->Host = "smtp.163.com";//邮箱smtp地址，此处以163为例
    $mail->Username = "boyyb87@163.com";//你的邮箱账号
    $mail->Password = "yb19870210";//你的邮箱密码
    $mail->From = "boyyb87@163.com";//你的邮箱账号
    $mail->FromName = "yb";
    $to = $email;//收件人邮箱地址
    $mail->AddAddress($to);
    $mail->Subject = "$username-密码找回";//主题
    $mail->Body = "校验码：".$code;//正文
    $mail->WordWrap = 80;
    //$mail->AddAttachment("f:/test.png"); //可以添加附件
    $mail->IsHTML(true);
    $mail->Send();
    echo "<script>alert('发送成功！请及时查看邮件！');</script>";
}

