/**
 * Created by Administrator on 14-11-16.
 */
$(document).ready(function(){
    $('#menu').tendina({
        openCallback: function(clickedEl) {
            clickedEl.addClass('opened');
        },
        closeCallback: function(clickedEl) {
            clickedEl.addClass('closed');
        }
    });

});
$(function(){

    $("#ad_setting").mouseover(function(){
        $("#ad_setting_ul").show();
    });
    $("#ad_setting").mouseout(function(){
        $('#ad_setting_ul').hide();
    });
    $("#ad_setting_ul").mouseleave(function(){
        $(this).hide();
    });
    $("#ad_setting_ul li").mouseenter(function(){
        $(this).find("a").attr("class","ad_setting_ul_li_a");
    });
    $("#ad_setting_ul li").mouseleave(function(){
        $(this).find("a").attr("class","");
    });

    $('.save').click(function(){
        var url = $('#win input[name=url]').val();
        var url_logout = $('#win input[name=url_logout]').val();
        var username = $('#win input[name=username]').val();
        var pwd = $('#win input[name=pwd]').val();
        var npwd = $('#win input[name=npwd]').val();
        var cnpwd = $('#win input[name=cnpwd]').val();
        if(!username){
            $('.hint_cp').css('color','red').html("参数错误，无法识别管理员！");
            return;
        }
        if(!pwd || !npwd || !cnpwd){
            $('.hint_cp').css('color','red').html("数据不能为空！");
            if(!pwd){$('#win input[name=pwd]').addClass('hint');}
            if(!npwd){$('#win input[name=npwd]').addClass('hint');}
            if(!cnpwd){$('#win input[name=cnpwd]').addClass('hint');}
            return;
        }
        if(npwd.length < 4){
            $('.hint_cp').css('color','red').html("密码长度至少4位！");
            $('#win input[name=npwd]').addClass('hint');
            return;
        }
        if(npwd != cnpwd){
            $('.hint_cp').css('color','red').html("两次输入的新密码不一致！");
            $('#win input[name=npwd]').addClass('hint');
            $('#win input[name=cnpwd]').addClass('hint');
            return;
        }
        if(npwd == pwd){
            $('.hint_cp').css('color','red').html("新旧密码一样，请重新修改！");
            $('#win input[name=npwd]').addClass('hint');
            return;
        }

        $('.hint_cp').css('color','green').html("保存中...");
        $.post(
            url,
            {"password":pwd,"npassword":npwd,"username":username},
            function(data){
                if(data == "opwd_error"){
                    $('#win input[name=pwd]').addClass('hint');
                    $('.hint_cp').css('color','red').html("原密码错误！");
                    return;
                }
                if(data == "ok"){
                    $('#win input[name]').removeClass('hint');
                    jump(url_logout,3);
                    return;
                }
                if(data == "fail"){
                    $('.hint_cp').css('color','green').html("修改失败！");
                    $('#win input[name]').removeClass('hint');
                    return;
                }
            }
        );

    });
    $('#win input[name]').click(function(){
        $(this).removeClass('hint');
        $('.hint_cp').html("");
    });
});

function showWin(){
    /*找到div节点并返回*/
    var winNode = $("#win");
    //方法一：利用js修改css的值，实现显示效果
    // winNode.css("display", "block");
    //方法二：利用jquery的show方法，实现显示效果
    // winNode.show("slow");
    //方法三：利用jquery的fadeIn方法实现淡入
    winNode.fadeIn("normal");
    //初始化窗口中的表单数据
    $('#win input[type=password]').removeClass('hint').val('');
    $('#win .hint_cp').html('');
    //增加遮罩
    $('.mask').css('display','block');
}
function hide(){
    var winNode = $("#win");
    //方法一：修改css的值
    //winNode.css("display", "none");
    //方法二：jquery的fadeOut方式
    winNode.fadeOut("fast");
    //方法三：jquery的hide方法
    winNode.hide("slow");
    $('.mask').css('display','none');
}

//倒计时跳转功能
function jump(url,num){
    if(num==0){
        window.location.href=url;
    }else{
        setTimeout(function(){
            $('.hint_cp').css('color','gray').html("修改密码成功 ("+num+")秒后将自动注销账户！");
            num--;
            jump(url,num);
        },1000)
    }
}