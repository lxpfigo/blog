{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 评论用户管理</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-sm-2 col-xs-12 sidebar-offcanvas" id="sidebar">
			<div class="list-group">
				<a class="list-group-item " href="{$APP}/Admin/User/index">管理员列表</a>
				<a class="list-group-item active" href="javascript:void(0)">评论用户列表</a>
			</div>
		</div>
		
		
		<div class="col-sm-10 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">用户列表</a></li>
			  <li class="active">评论用户列表</li>
			</ol>
		<table class="table table-striped">
			<tr class="success"><th>#</th><th>头像</th><th>昵称</th><th>IP</th><th>加入时间</th><th>邮箱</th><th>地区</th><th>操作</th></tr>
			{foreach from=$commentUser item=v key=k}
				<tr>
					<td>{$k + $ps}</td>
					<td style="vertical-align: middle;"><img src="{$v.img}" style="width: 40px;"></td>
					<td>{$v.nickname}</td>
					<td>{$v.IP}</td>
					<td>{$v.join_time|date_format:"%y-%m-%d %H:%M"}</td>
					<td>{$v.email}</td>
					<td>{$v.location}</td>
					
					<td>
						<div class="dropdown">
							<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								操作<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="{$APP}/Admin/User/del/id/{$v['comment_user_id']}"><i class="fa fa-trash" style="color: red;"></i>&nbsp;删除</a></li>
							</ul>
						</div>
					</td>
				</tr>
			{/foreach}
		</table>
		{$show}
		</div>
	</div>
</div>
{include file="Public/footer.tpl"}
<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
	$(function(){
	
		$('.del').click(function(e){
			var first = $(this).parents('tr').children('td:eq(1)').text();
//			e.preventDefault();
			var r = confirm("是否确定要删除“"+ first +"”?删除后该信息将无法恢复");
			if(!r){
				return false;
			}
			
		})
	});
</script>
</body>
</html>