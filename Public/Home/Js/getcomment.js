$(function(){


var p = 1;
loadComment(p, getcommentUrl, articleId);

	$('#load-comment').click(function(){
		p++;
		loadComment(p, getcommentUrl, articleId);
	});

	//发表评论
	var alertMode = $('#alter');
	$('#share').click(function(){
		if($('#info').val() == ''){
			return false;
		}
		$('#share').html('<i class="fa fa-spinner fa-pulse"></i>信息发送中，请稍后。。。').attr('disabled', 'disabled');
		$.ajax({
			type:"post",
			url:sharecommentUrl,
			data:{'info':$('#info').val(), 'articleId':articleId},
			dataType: 'json',
			success: function(data){

				if(data == 0)
				{
					alertMode.addClass('alert-danger').css('display', 'block').removeClass('alert-success');
					alertMode.children('strong').html('请将信息填写完整！')
					$('#share').html('发布').removeAttr('disabled');
				}else if(data == 1 || data == 3)
				{
					alertMode.addClass('alert-danger').css('display', 'block').removeClass('alert-success');
					alertMode.children('strong').html('发送失败，请重新发送！')
					$('#share').html('发布').removeAttr('disabled');
				}else{
					alertMode.addClass('alert-success').css('display', 'block').removeClass('alert-danger');
					alertMode.children('strong').html('发布成功!');
					//将该评论加载出来
					$('.comment ul li').remove();
					loadComment(p, getcommentUrl, articleId);
					$('#info').val('');
					$('#share').html('发布').removeAttr('disabled');
				}

			}

		});
	});


	//加载数据
	function loadComment(p, getcommentUrl, articleId)
	{
		var moreComment = $('#load-comment');
		moreComment.html('<i class="fa fa-spinner fa-pulse fa-lg"></i>  数据加载中。。。').attr('disabled', 'disabled');
		$.ajax({
			type:"post",
			url:getcommentUrl,
			data:{'p': p, 'articleId':articleId},
			dataType: 'json',
			success: function(data){
				if(data.data.length == 0){
					$('#no-comment').show();
					$('#load-comment').hide();
				}
				if(data.status == 1){
					moreComment.html('<i class="fa fa-refresh"></i> 加载更多').removeAttr('disabled').removeClass('color');
				}else{
					moreComment.html('<i class="fa fa-coffee fa-large"></i>  没有更多评论，休息一下吧！').removeClass('color')
					.css('color', '#D7D7D7');
				}
				//加载数据
				var Commentlists = '';
				$.each(data.data, function(index, v) {
					var time = formatTime(v.comment_time * 1000);
					Commentlists += '<li>' +
										'<img src="'+ v.img +'" class="img-responsive img-rounded" />' +
										'<h5>'+ v.nickname +'</h5>' +
										'<span>'+ time +'<font style="color:#666699; margin-left: .2rem;font-size:.12rem">'+v.location+'</font></span>' +
										'<p>'+ v.comment_info +'</p>' +
									'</li>';
					});
					$('.comment ul').append(Commentlists);
			},error:function(data){
				moreComment.html('<i class="fa fa-refresh"></i> 网络错误，请重试').removeAttr('disabled').removeClass('color');
			}
		});
	}
function formatTime($time)
{
	var date = new Date($time);
	console.log(date);
	var Y = date.getFullYear();
	var M = (date.getMonth() + 1) < 10 ? '0' + date.getMonth() : date.getMonth();
	var D = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
	var h = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
	var m = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
	return Y + '-' + M + '-' + D + ' ' + h + ':' + m;
}
});
