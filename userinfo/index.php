<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户个人资料</title>
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
    </style>
    <script src="../public/js/jquery-2.2.4.min.js"></script>
    <script>
        $(function(){
            
            //验证数据

        });
    </script>
</head>
<body style="background:#f2f9f2;">
    <table  width="700px" align="center" style="background: white;margin-top:50px;">
        <!--<tr>
            <td rowspan="15">
                <img style="height:40px;height:40px;background: grey;" src=""/>
            </td>
            <td></td>
            <td></td>
        </tr>-->
        <tr height="30">
            <td colspan="3"><div id="base">用户信息</div></td>
        </tr>
        <tr height="10">
            <td colspan="2"></td>
            <td rowspan="5" width="100" align="left" valign="top">
                <img style="height:60px;width:60px;background: grey;margin-top:20px;" src=""/>
            </td>
        </tr>
        <tr height="35">
            <td width="50" align="right">用户名：</td>
            <td width="140">
                <input type="text" disabled/>
            </td>
        </tr>
        <tr height="35">
            <td align="right">性别：</td>
            <td>
                <input type="text" disabled/>
            </td>
        </tr>
        <tr height="35">
            <td align="right">电话号码：</td>
            <td>
                <input name="phone" type="text"/>
            </td>
        </tr>
        <tr height="35">
            <td align="right">邮箱：</td>
            <td>
                <input name="email" type="text"/>
            </td>
        </tr>
        <tr height="35">
            <td colspan="3" align="center">
                <a id="isubmit" href="javascript:void(0)">更新</a>
                <a id="back" href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a>
            </td>
        </tr>
        <tr height="50"><td colspan="3">
                <span id="error_info"></span>
            </td></tr>
        <tr height="30">
            <td colspan="3"><div id="cpwd">密码修改</div></td>
        </tr>
        <tr height="35">
            <td align="right">原始密码：</td>
            <td>
                <input type="password" name="opassword"/>
            </td>
        </tr>
        <tr height="35">
            <td align="right">新密码：</td>
            <td>
                <input type="password" name="npassword"/>
            </td>
        </tr>
        <tr height="35">
            <td align="right">确认密码：</td>
            <td>
                <input type="password" name="cpassword"/>
            </td>
        </tr>
        <tr height="35">
            <td colspan="3" align="center">
                <a id="psubmit" href="javascript:void(0)">修改密码</a>
            </td>
        </tr>
    </table>
</body>
</html>