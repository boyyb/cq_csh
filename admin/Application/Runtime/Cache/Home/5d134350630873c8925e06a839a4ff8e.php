<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>administrators</title>
    <link rel="stylesheet" href="/1_csh/admin/Public/Index_style/css/index.css" type="text/css" media="screen" />
    <script src="/1_csh/admin/Public/Js/jquery-2.2.4.min.js"></script>
    <style>
        body{margin: 6px 0 0 10px;}
        table{
            margin-top:10px;
            border: 1px solid #cccccc;
            background: snow;
        }
        table th,table td{
            border: 1px solid #cccccc;
            text-align:center;
        }
        table th{
            background: #b7d2ff;
        }
        .delAdmin ,.updateAdmin{
            color:dodgerblue;
            text-decoration: none;
        }
        .delAdmin:hover ,.updateAdmin:hover{
            color:red;
            text-decoration: underline;
        }
        .delch{
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
        }
    </style>
    <script>
        $(function(){
            $('.delAdmin').click(function(){
                var r = window.confirm("确认要删除吗？删除后不可恢复！");
                if(!r){return false;}
                var id = $(this).find('b[style]').html();
                $.post(
                        "<?php echo U('admin/delete');?>",
                        {"id":id},
                        function(data){
                            if(data == "1"){
                                alert('删除成功！');
                                window.location.reload();
                            }else{
                                alert('删除失败')
                            }
                        }
                );
            });

            //复选框 全选 全不选
            $('.chall').click(function(){
                if($(this).is(':checked')){
                    $('.ch').prop('checked',true);
                }else{
                    $('.ch').prop('checked',false);
                }
            });
            //复选框 自动判断是否勾选全选
            $('.ch').click(function() {
                //找出没有被选中的，并计算个数
                if($('.ch').filter(':not(:checked)').size()>0){
                    $('.chall').prop('checked', false);
                }
                if($('.ch').filter(':not(:checked)').size()==0){
                    $('.chall').prop('checked', true);
                }
            });
            //删除选中
            $('.delch').click(function(){
                //判断是否有选中项
                if($(".ch:checked").length == 0){
                    alert("请选择至少一个选项！");
                    return;
                }

                var num = $(".ch:checked").length;//获取选中的个数，同size()

                var r = window.confirm("确认要删除所选管理员吗？删除后不可恢复！");
                if(r){
                    var s='';
                    $('input[class="ch"]:checked').each(function(){
                        if($(this).val()){
                            s += $(this).val()+',';
                        }
                    });
                    var allChId = s.substring(0,s.length-1);
                    //alert(allChId);
                    $.post(
                            "<?php echo U('admin/delCh');?>",
                            {"ids":allChId,"num":num},
                            function(data){
                                if(data=="1"){
                                    alert("删除成功！");
                                    window.location.reload();
                                }else{
                                    alert("删除失败！");
                                }


                            }
                    );
                }

            });
        });
    </script>
</head>
<body>
<div class="route_bg">
    <a href="javascript:void(0)">管理员信息</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="javascript:void(0)">管理员列表</a>
</div>
<table border="1" style="border-collapse: collapse" width="95%">
    <tr height="25">
        <th width="25"><input type="checkbox" class="chall"/></th>
        <th width="40" nowrap="">序号</th>
        <th width="80" nowrap="">用户名</th>
        <th width="80" nowrap="">管理等级</th>
        <th width="50" nowrap="">状态</th>
        <th width="60" nowrap="">添加时间</th>
        <th width="100" nowrap="">上次登录时间</th>
        <th width="180">备注</th>
        <th width="80" nowrap="">操作</th>
    </tr>
    <?php if(is_array($data)): foreach($data as $k=>$v): ?><tr height="25">
            <td><?php if($v['username'] != 'root'): ?><input type="checkbox" value="<?php echo ($v["id"]); ?>" class="ch" /><?php endif; ?></td>
            <td><?php echo ($k+1); ?></td>
            <td nowrap><?php echo ($v["username"]); ?></td>
            <td><?php if($v['level'] == 0): ?>超级管理员<?php else: ?>普通管理员<?php endif; ?></td>
            <td><?php if($v['state'] == 0): ?>未激活<?php else: ?>已激活<?php endif; ?></td>
            <td><?php echo (date("Y-m-d",$v["add_time"])); ?></td>
            <td><?php if($v['recent_login'] > 0): echo (date("Y-m-d H:i",$v["recent_login"])); else: ?>未登录过<?php endif; ?> </td>
            <td><?php if(strlen($v['note']) > 45): echo (mb_substr($v["note"],0,15,'utf-8')); ?>...<?php else: echo ($v["note"]); endif; ?></td>
            <td>
                <?php if($v['username'] == 'root'): ?><a onclick="alert('root账户不允许删除！')" style="color:gray;cursor:not-allowed;">删除</a>
                <?php else: ?><a class="delAdmin" href="javascript:void(<?php echo ($v['id']); ?>)">删除<b style="display:none;"><?php echo ($v["id"]); ?></b></a><?php endif; ?>&nbsp;|&nbsp;
                <a href="<?php echo U('admin/update',array('id'=>$v['id']));?>" class="updateAdmin">修改</a>
            </td>
        </tr><?php endforeach; endif; ?>
    <tr height="30">
        <td colspan="9" style="text-align: left;padding-left:10px;"><a class="delch" href="javascript:void(0)">删除选中</a></td>
    </tr>

</table>

</body>
</html>