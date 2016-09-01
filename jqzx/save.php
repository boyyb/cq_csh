<?php
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");

function get_client_ip(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
        $ip = getenv("HTTP_CLIENT_IP");
    }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
        $ip = getenv("REMOTE_ADDR");
    }else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
        $ip = $_SERVER['REMOTE_ADDR'];
    }else{
        $ip = "unknown";

    }
    return($ip);
}

if(isset($_REQUEST)){
    require_once "../public/class/db.class.php";
    $db = new DB();
    $username = $_REQUEST['user'];
    if($username == "游客"){
        $_REQUEST['photo']="default.jpg";
    }else{
        $user_id = $db->getOne("user","id","username='$username'");
        $user_id = $user_id['id'];
        $user_image = $db->getOne("user_pic","pic_name","id=$user_id");
        $user_image = $user_image['pic_name'];
        if($user_image){
            $_REQUEST['photo'] = $user_image;
        }else{
            $_REQUEST['photo']="default.jpg";
        }
    }
    $_REQUEST['ip'] = get_client_ip();
    $_REQUEST['time'] = time();
    $_REQUEST['username'] = $username;
    $data_arr = $db->create("news_comment",$_REQUEST);
    $db->add("news_comment",$data_arr);
    if($db->getLastId()) {
        echo "<table width=\"100%\" border=\"1\" style=\"margin:5px auto;\">
                   <tr heigh=\"25\">
                       <td colspan=\"4\" align=\"left\" >
                           1楼 zxxtjt 2015-09-05 18:23发表
                       </td>
                   </tr>
                   <tr>
                       <td width=\"60\" align=\"left\" valign=\"top\">
                           <img style=\"height:50px;width:50px;margin-top: 8px;\" src=\"\"/>
                       </td>
                       <td align=\"left\">
                           7878787878787878787878787878787878787878787878787878787878878878
                           7888888888888888888888888888888888888888888888888888888888888888
                       </td>
                   </tr>
               </table>";
    }

}else{
    die("非法访问！");
}
