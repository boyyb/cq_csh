$(document).ready(function(){
    $('#zxly_message input[type=button],#zxly_message input[type=reset]').mouseover(function(){
        $(this).css('background','#f86d0d').css('color','white');
    });
    $('#zxly_message input[type=button],#zxly_message input[type=reset]').mouseout(function(){
        $(this).css('background','#ddd').css('color','black');
    });

    $('#zxly_message input[type=button]').click(function(){
        //获取表单的值
        var topic = $('#zxly_message input[name=topic]').val();
        var email = $('#zxly_message input[name=email]').val();
        var name = $('#zxly_message input[name=name]').val() || "游客";
        var phone = $('#zxly_message input[name=phone]').val();
        var content = $('#zxly_message textarea[name=content]').val();
        var type = $("#zxly_message input[name=type][type='radio']:checked").val();//获取单选框的值
        //必填项检查
        if(!topic || !email || !content || !type){
            $('#errorMsg').html("带\"*\"的为必填项，请检查填写内容！");
            return false;
        }
        //主题字数不超过30
        if(topic.length>30){
            $('#errorMsg').html("主题不超过30个字！");
            return false;
        }
        //email格式检查
        var emailRe = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
        if(!emailRe.test(email)){
            $('#errorMsg').html("邮箱格式不正确！");
            return false;
        }
        //电话号码检查
        if(phone && isNaN(phone)){
            $('#errorMsg').html("电话号码格式不正确！");
            return false;
        }
        //留言内容大于5个字
        if(content.length<5){
            $('#errorMsg').html("留言内容至少5个字！");
            return false;
        }
        $('#errorMsg').css('color','green').html("提交中...");
        $('#zxly_message input[type=button]').prop('disabled','disabled');
        //ajax 提交数据
        $.post(
            'http://localhost/1_csh/zxly/message.php',
            {"topic":topic,"email":email,"name":name,"phone":phone,"content":content,"type":type},
            function(data){
                if(data=="ok"){
                    $('#errorMsg').css('color','green').html("提交成功！");
                    $('#zxly_message input[type=reset]').click();
                }else{
                    $('#errorMsg').css('color','red').html("提交失败！");
                }
                $('#zxly_message input[type=button]').removeAttr('disabled');
            }
        );


    });






});
