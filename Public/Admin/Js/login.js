$(function(){
    $('#chage-code').click(function(){
        getCode();
    });

    var username = $('#username');
    var password = $('#password');
    var code = $('#code');
    $('#username, #password, #code').blur(function(){
        if($(this).val() == ''){
            $(this).parents('.form-group').addClass('has-error');
        }else{
            $(this).parents('.form-group').removeClass('has-error');
        }
    })

    //登录
    $('#submit').click(function(){
        if(username.val() =='' || password.val() == '' || code.val() == ''){
            $('#alert-info').children('div').remove();
            $('#alert-info').append('<div class="alert alert-dismissible alert-danger" role="alert"><strong>错误!</strong> 请将信息填写完整</div>')
            return false;
        }

        $.ajax({
            type:"post",
            url: appName + "/Admin/Login/doLogin",
            dataType:"json",
            data:{ 'username':username.val(), 'password':password.val(), 'code':code.val()},
            success:function(data){
                if(data.status == 0){
                    $('#alert-info').children('div').remove();
                    $('#alert-info').append('<div class="alert alert-dismissible alert-danger" role="alert"><strong>错误!</strong> 验证码错误，请重新填写</div>')	;
                    getCode();
                }else if(data.status == 1){
                    $('#alert-info').children('div').remove();
                    $('#alert-info').append('<div class="alert alert-dismissible alert-danger" role="alert"><strong>错误!</strong> 不允许空值提交</div>')	;
                }else if(data.status == 2){
                    $('#alert-info').children('div').remove();
                    getCode();
                    $('#alert-info').append('<div class="alert alert-dismissible alert-danger" role="alert"><strong>错误!</strong> 用户名或密码错误！</div>')	;
                }else if(data.status == 10){
                    $('#alert-info').children('div').remove();
                    $('#submit').html('登录成功，跳转中。。。').addClass('btn-success');
                    window.location.href = data.url;
                }
            },
            error:function(){
                $('#alert-info').children('div').remove();
                $('#alert-info').append('<div class="alert alert-dismissible alert-danger" role="alert"><strong>错误!</strong> 网络连接失败，请重试！</div>')	;
            }
        });

    });
    //获取验证码
    function getCode()
    {
        var time = new Date().getTime();
        $('#chage-code').attr('src', appName + "/Admin/Login/code" + "?time=" + time);
    }
});