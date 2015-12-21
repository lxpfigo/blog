$(function() {
    $(window).scroll(function () {
        if ($('.weibo-ajax').length > 0) {
            $('.weibo-ajax').css({
                'top': $(window).height() / 2 + $(window).scrollTop() - $('.weibo-ajax').height() / 2,
            });
        }

    });
    $('#weibo').click(function () {
//			var href=window.open();
        $('body').append('<div class="mask"></div>');
        $('body').append('<p class="weibo-ajax"><i class="fa fa-spinner fa-spin fa-pulse fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;数据准备中，请稍后。。。</p>');
        $('.weibo-ajax').css({
            'top': $(window).height() / 2 + $(window).scrollTop() - $('.weibo-ajax').height() / 2,
        });

        $.ajax({
            type: "post",
            url: shareWeibo,
            dataType: "json",
            data: {'id': articleId},
            success: function (data) {
                window.location.href = data;
                out();
            },
            error: function () {
                $('.weibo-ajax').html('<i class="fa fa-remove fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;网络连接失败，请重试！');
                setTimeout(function () {
                    out();
                }, 1000)
            }
        });
    });
    //点击评论框进行登录
    $('#info').click(function() {
           if (isWeibo == 0) {
            var top = Math.ceil(($(window).height() - 600)/2);
            var left = Math.ceil(($(window).width() - 800)/2);
            //var newWindow = window.open("", 'newwindow', 'height=600, width=800, top=' + top + ',left=' + left + ', toolbar=no,menubar=no, scrollbars=no, resizable=no,location=no, status=no');
            var url = encodeURIComponent(window.location.href);
               window.location.href = root + "/weibo/index?url=" + url;
        }
    });
});



function out() {
    $('.mask').fadeOut(800, function () {
        $('.mask').remove();
    });
    $('.weibo-ajax').fadeOut(1200, function () {
        $('.weibo-ajax').remove();
    });
}
