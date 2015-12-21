$(function(){
	//判断用户是否在微信上使用
	var UA = window.navigator.userAgent.toLowerCase();
	//fontInit();
	function fontInit()
	{
		var clientW = $(window).width();
		if(clientW < 768){
			$('html').css('font-size', (clientW/768)*100*1.75);
		}else{
			$('html').css('font-size', 100);
		}
	}

	$(window).resize(function(){
		//fontInit();
	});

	//加载canvas
	var c = $('.cavas');
	c.each(function(){
		var self = this;
		var imgObj = new Image();
		imgObj.src = $(this).attr('data-src');
		var ctx = $(this)[0].getContext("2d");
		imgObj.onload = function () {
			self.width = this.width;
			self.height = this.height;
			ctx.drawImage(this, 0, 0, self.width, self.height);
		}
		$(this).removeAttr('data-src').css('background','none');
	});

	//弹出
	function popup() {
		var popup = '<div id="popup">' +
				'<i class="fa fa-level-up fa-3x fa-fw"></i>' +
				'<div>' +
				'<span>点击右上角菜单可以分享到朋友圈</span><span>以浏览器打开可以与我互动</span>' +
				'</div>' +
				'</div>';
		$('body').before(popup);
		var _popup = $('#popup');
		_popup.slideDown(800);
		setTimeout(function () {
			_popup.fadeOut(800);
		}, 8000);
	}
	
	//生成文章二维码
	$('#wechat').bind('click', function(){
		//如果是在微信打开
		if ((/MicroMessenger/i).test(UA)) {
			gotoTop();
			popup();
			return false;
		}
			//二维码大小

		$('body').append('<div class="mask"></div>');
//		var codeH = $('#qrcode').height();
//		var codeW = $('#qrcode').width();
		$('#qrcode').css({
			'left':'50%',
			'margin-left':-$('#qrcode').width()/2,
			'top':$(window).scrollTop() + 185 - $('#qrcode').height()/2
			
		});
		if($('#qrcode canvas').length == 0){
			$('#qrcode').qrcode({
			width: 240,
			height: 240,
			text: qrcodeUrl + articleId + "?t=" + new Date().getTime()
		});			
		}
		$('#qrcode canvas').addClass('img-responsive')
		$('#qrcode').fadeIn();
		
	});
//隐藏二维码
$('#qrcode button').click(function(){
	$('.mask').fadeOut().remove();
	$('#qrcode').fadeOut('', function(){
		$('#qrcode canvas').remove();
	});
});

	//滚动鼠标始终在屏幕中央
	$(window).scroll(function(){
		if($('#qrcode').css('display') == 'block'){
			$('#qrcode').css({
				'top':$(window).scrollTop() + $(window).height()/2 - $('#qrcode').height()/2
			});			
	}
	});

		//在小屏幕下点击后菜单消失
		$('#menu li').click(function(){
	    	$('#soc').removeClass('move1');
			$('#soc > span').removeClass('move2');
			setTimeout(function(){
				$('.span-hide').css('visibility', 'visible')
			}, 790);			
			$('#menu').collapse('hide');
		});
		
		//显示微信二维码
//		$('.me > li > a').click(function(){
//				$(this).next('ul').slideDown();		
//		});


		//发布评论

			var l = $('.share-comment').find('.form-control');
			$.each(l, function(index, v) {
				$(this).blur(function(){
					if($(this).val() == ''){
						$(this).parents('.form-group').addClass('has-error').removeClass('has-success');
//						$('#share').attr('disabled', 'disabled');
					}else{
						$(this).parents('.form-group').addClass('has-success').removeClass('has-error');
					}
				});
			});
			$('#share').click(function(){
				if($('#nickname').val() == '' || $('#email').val() == '' || $('#info').val() == ''){
					return false;
				}
			});
			
		//回到顶部
		$(window).scroll(function(){
			if($(window).scrollTop() > 40){
				$('#goto-top').fadeIn(850);
			}else{
				$('#goto-top').fadeOut(850);
			}
		});
		//点击回到顶部
		$('#goto-top').click(function(){
			gotoTop();
		});
		function gotoTop(){
			if($(window).scrollTop() > 0){
				var now = $(window).scrollTop();
				var one = -Math.ceil(now/3);
				$(window).scrollTop(now + one);
				setTimeout(gotoTop, 30);
			}else{
				return false;
			}
		}
	//导航图标变化
	$('#nav').click(function(){
		if(!$('#menu').hasClass('in')){
			$('.span-hide').css('visibility', 'hidden')
	    	$('#soc').addClass('move1');
			$('#soc > span').addClass('move2');
		}else{			
	    	$('#soc').removeClass('move1');
			$('#soc > span').removeClass('move2');
			setTimeout(function(){
				$('.span-hide').css('visibility', 'visible')
			}, 750);
		}

	});
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
});
