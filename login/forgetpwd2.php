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
<p>方式2：通过手机找回(将密码发送到注册手机上)</p>
<hr/>
<form action="" method="post">
    <p><input name="username" placeholder="账户名称"/></p>
    <p><input name="phone" placeholder="手机号码" /></p>
    <p><input type="submit" value="发送"/></p>
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
    if($_REQUEST['username'] && $_REQUEST['phone']){
        $data = $db->getOne('user',"*","username='$username'");
        if(!$data){
            die("用户名不存在！");
        }
        $res = $db->getOne("user","*","username='$username' and phone='$phone'");
        if(!$res){
            die("手机号码不正确！");
        }else{
            $code = $res['password'];
        }
    }else{
        die("数据输入不完整！");
    }

/**
 * 验证码通知短信接口
 */
require_once("../public/api_sms/include/config.php");
require_once("../public/api_sms/include/httpUtil.php");

/**
 * url中{function}/{operation}?部分
 */
$funAndOperate = "industrySMS/sendSMS";

// 参数详述请参考http://miaodiyun.com/https-xinxichaxun.html

// 生成body
$body = createBasicAuthData();
// 在基本认证参数的基础上添加短信内容和发送目标号码的参数
$body['smsContent'] = "【长寿湖】尊敬的会员： 您的密码是 {$code}，请妥善保存！";
$body['to'] = '13629795255';

// 提交请求
$result = post($funAndOperate, $body);
//echo("<br/>result:<br/><br/>");
//var_dump($result);

    $ret = json_decode($result);
    if($ret->respCode=="00000"){
        echo "<script>alert('短信已经发送到{$phone}，请注意查收！');</script>";
    }
}

