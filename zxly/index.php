<?php
require_once '../public/class/db.class.php';
$db = new DB();
$data = $db -> getAll('message','*','',"time desc","0,10");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>在线留言</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link href="../public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="../public/css/dropmenu.css" rel="stylesheet" type="text/css"/>
    <script src="../public/js/jquery.min.js" type="text/javascript"></script>
    <script src="../public/js/comm.js" type="text/javascript"></script>
    <script src="../public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="../public/js/zxly.js" type="text/javascript"></script>
    <script type="text/javascript">var submenu_style = 1;</script>
</head>
<body>
<!--引入公共头部-->
<?php include "../public/common/header.php";?>

   <div id="zxly_message">
       <form action="" method="post">
           <table width="80%" align="center">
                <tr height="30">
                    <td nowrap width="180px;" align="right"><span style="color:red;">*</span>留言主题：</td>
                    <td colspan="5" align="left" style="padding-left:10px;">
                        <input name="topic" style="width:200px;"/>
                    </td>
                </tr>
                <tr height="30">
                   <td nowrap align="right"><span style="color:red;">*</span>email：</td>
                   <td align="left" style="padding-left:10px;">
                       <input name="email" style="width:200px;"/>
                   </td>
                </tr>
                <tr height="30">
                   <td nowrap align="right">联系人：</td>
                   <td align="left" style="padding-left:10px;">
                       <input name="name" style="width:200px;"/>
                   </td>
                </tr>
                <tr height="30">
                   <td nowrap align="right">电话：</td>
                   <td align="left" style="padding-left:10px;">
                       <input name="phone" style="width:200px;"/>
                   </td>
                </tr>
                <tr height="115">
                    <td nowrap align="right"><span style="color:red;">*</span>留言内容：</td>
                    <td align="left" style="padding-left:10px;">
                        <textarea name="content"></textarea>
                    </td>
                </tr>
                <tr height="30">
                   <td nowrap align="right"><span style="color:red;">*</span>留言分类：</td>
                   <td align="left" style="padding-left:10px;">
                       <input type="radio" name="type" value="咨询" id="zx" /><label for="zx">咨询</label>&nbsp;&nbsp;
                       <input type="radio" name="type" value="建议" id="jy" /><label for="jy">建议</label>&nbsp;&nbsp;
                       <input type="radio" name="type" value="投诉" id="ts" /><label for="ts">投诉</label>&nbsp;&nbsp;
                       <input type="radio" name="type" value="其他" id="qt" /><label for="qt">其他</label>
                   </td>
                </tr>
               <tr height="30">
                   <td></td>
                   <td align="left" style="padding-left:10px;color:red;">
                       <span id="errorMsg"></span>
                   </td>
               </tr>
                <tr height="30">
                    <td colspan="2" align="center">
                        <input type="button" value="提交">
                        <input type="reset" value="重置">
                    </td>
                </tr>
           </table>
       </form>

   </div>
   <div id="zxly_show">
       <div id="zxly_show_title" class="box_title">最&nbsp;近&nbsp;留&nbsp;言</div>
       <?php foreach($data as $k=>$v){?>
       <div class="zxly_show_box">
           <table width="100%" align="center" >
               <tr height="30">
                   <td align="left" width="260"><?php echo $v['type'],'：',$v['topic'];?></td>
                   <td align="left" width="210">email：<?php echo $v['email'];?></td>
                   <td align="left" width="170">留言人：<?php echo $v['name'];?></td>
                   <td align="left" width="170">电话：<?php echo $v['phone'];?></td>
                   <td align="right">留言时间：<?php echo date('Y-m-d H:i:s',$v['time']);?></td>
               </tr>
               <tr height="100">
                   <td colspan="5" align="left" valign="top" class="td_content">
                       <span>留言内容：<?php echo $v['content'];?></span>
                   </td>
               </tr>
           </table>
       </div>
       <?php }?>
   </div>

<!------------------------底部开始----------------------------->
<?php include "../public/common/footer.php";?>
<!------------------------底部结束----------------------------->
</body>
</html>