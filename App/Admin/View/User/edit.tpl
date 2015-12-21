{include file="Public/header.tpl"}
<link rel="stylesheet" href="{APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 修改用户信息</title>
<script>
	var url = "{$APP}/Admin/User/doEdit/id/{$data['user_id']}";
	var changeUrl = "{$APP}/Admin/User/changeImg";
</script>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-sm-2 col-xs-6 sidebar-offcanvas" id="sidebar">
			<div class="list-group">
				<a class="list-group-item " href="{$APP}/Admin/User/index">管理员列表</a>
				<a class="list-group-item active" href="{$APP}/Admin/Comment/index">修改管理员</a>
			</div>
		</div>
		
		
		<div class="col-sm-10 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">用户列表</a></li>
			  <li class="active">修改管理用户</li>
			</ol>
		
		<form class="form-horizontal" action="{$APP}/Admin/User/doEdit/id{$data['user_id']}" method="post">
			<div class="form-group">
				<label class="col-sm-2 control-label">头像</label>
				<div class="col-sm-4">
					<img src="{$data.img}" style="width: 40px;cursor: pointer" id="img" title="点击图片更改图像" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">登录名</label>
				<div class="col-sm-4">
					<input type="text" value="{$data.username}" id="username" class="form-control" disabled="disabled" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">昵称</label>
				<div class="col-sm-4">
					<input type="text" value="{$data.nickname}" id="nickname" class="form-control" />
				</div>
			</div>	


			
			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-2">
					<input type="button" class="btn btn-default" value="修改" id="change" />
				</div>
			</div>
		</form>
		
		</div>
	</div>
</div>
{include file="Public/footer.tpl"}
<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
$(function(){
	//点击图片更换头像
	$('#img').click(function(){
		$.ajax({
			type:"post",
			url: changeUrl,
			dataType:"json",
			success:function(data){
				$('#img').attr('src', data);
			}
		});
	});
	$('#change').click(function(){
		$.ajax({
			type:"post",
			url: url,
			dataType:"json",
			data:{ 'img':$('#img').attr('src'), 'nickname':$('#nickname').val() },
			success:function(data){
				if(data.status == 1){
					window.location.href = data.info;
				}else{
//					alert('修改失败，请重试');
				}
			},
			error:function(){
//				alert('网络错误，请重试');
			}
		});		
	});
		
});
</script>
</body>
</html>