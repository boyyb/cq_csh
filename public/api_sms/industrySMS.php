<?php
/**
 * 验证码通知短信接口
 */
require_once("include/config.php");
require_once("include/httpUtil.php");

/**
 * url中{function}/{operation}?部分
 */
$funAndOperate = "industrySMS/sendSMS";

// 参数详述请参考http://miaodiyun.com/https-xinxichaxun.html

// 生成body
$body = createBasicAuthData();
// 在基本认证参数的基础上添加短信内容和发送目标号码的参数
$code = '1234';
$body['smsContent'] = "【长寿湖】尊敬的会员： 您的密码是 {$code}，请妥善保存！";
$body['to'] = '13629795255';

// 提交请求
$result = post($funAndOperate, $body);
echo("<br/>result:<br/><br/>");
var_dump($result);